<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentBookingController extends Controller
{
    /**
     * Get doctor profile with necessary relationships.
     */
    protected function getDoctorProfile($userId)
    {
        return User::where('id', $userId)
            ->where('role', 'doctor')
            ->firstOrFail()
            ->doctorProfile()
            ->where('status', 'approved')
            ->with('specialization')
            ->first();
    }

    // Show doctor details with available schedules
    public function showDoctor($userId)
    {
        $doctor = $this->getDoctorProfile($userId);
        
        if (!$doctor) {
            return redirect()->route('patient.doctors')->with('error', 'ئەم پزیشکە نەدۆزرایەوە');
        }
        
        $schedules = $doctor->schedules()
            ->where('is_available', true)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        return view('patient.doctor-details', compact('doctor', 'schedules'));
    }
    
    // Show booking form with advanced scheduler data
    public function bookingForm($userId)
    {
        $doctor = $this->getDoctorProfile($userId);
        
        if (!$doctor) {
            return redirect()->route('patient.doctors')->with('error', 'ئەم پزیشکە نەدۆزرایەوە');
        }
        
        $schedules = $doctor->schedules()
            ->where('is_available', true)
            ->get();

        // Prepare availability data for the next 7 days
        $availability = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->addDays($i);
            $dayName = strtolower($date->format('l')); // match database lowercase (monday, etc)
            
            $daySchedules = $schedules->where('day_of_week', $dayName);
            
            $slots = [];
            foreach ($daySchedules as $schedule) {
                $bookedCount = Appointment::where('schedule_id', $schedule->id)
                    ->where('appointment_date', $date->format('Y-m-d'))
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->count();
                
                $slots[] = [
                    'id' => $schedule->id,
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                    'max_patients' => $schedule->max_patients,
                    'booked_count' => $bookedCount,
                    'is_full' => $bookedCount >= $schedule->max_patients,
                    'remaining' => max(0, $schedule->max_patients - $bookedCount),
                ];
            }
            
            $availability[] = [
                'date' => $date->format('Y-m-d'),
                'day_name' => $dayName,
                'display_date' => $this->convertToKurdishDay($dayName) . ' ' . $date->format('d/m'),
                'slots' => $slots,
            ];
        }
        $allTimes = $schedules->pluck('start_time')
            ->map(fn($time) => substr($time, 0, 5)) // HH:mm format
            ->unique()
            ->sort()
            ->values();
        
        return view('patient.book-appointment', compact('doctor', 'availability', 'allTimes'));
    }

    /**
     * Helper to convert day names to Kurdish.
     */
    private function convertToKurdishDay($day)
    {
        $days = [
            'monday' => 'دووشەممە',
            'tuesday' => 'سێشەممە',
            'wednesday' => 'چوارشەممە',
            'thursday' => 'پێنجشەممە',
            'friday' => 'هەینی',
            'saturday' => 'شەممە',
            'sunday' => 'یەکشەممە',
        ];
        return $days[strtolower($day)] ?? $day;
    }
    
    // Store appointment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor_profiles,id',
            'schedule_id' => 'required|exists:doctor_schedules,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'symptoms' => 'nullable|string',
        ]);
        
        $patientProfile = Auth::user()->patientProfile;
        
        if (!$patientProfile) {
            return back()->with('error', 'پرۆفایلی نەخۆش نەدۆزرایەوە');
        }
        
        $schedule = DoctorSchedule::findOrFail($validated['schedule_id']);
        
        // Check if schedule is available
        if (!$schedule->is_available) {
            return back()->with('error', 'ئەم خشتەی کاتە بەردەست نییە');
        }
        
        // Check if appointment capacity is reached
        $maxPatients = $schedule->max_patients;
        $bookedCount = Appointment::where('doctor_id', $validated['doctor_id'])
            ->where('schedule_id', $validated['schedule_id'])
            ->where('appointment_date', $validated['appointment_date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();
        
        if ($bookedCount >= $maxPatients) {
            return back()->with('error', 'ئەم کاتە پڕ بووە، تکایە کاتێکی تر هەڵبژێرە');
        }

        // Check if patient already has an active appointment for this exact slot
        $existingActive = Appointment::where('patient_id', $patientProfile->id)
            ->where('doctor_id', $validated['doctor_id'])
            ->where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $schedule->start_time)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($existingActive) {
            return back()->with('error', 'تۆ پێشتر داواکاریت ناردووە بۆ ئەم کاتە، ناتوانیت دووبارە هەمان کات بگریت');
        }
        
        // Use a transaction for safety
        DB::transaction(function () use ($validated, $patientProfile, $schedule, $bookedCount) {
            // Remove cancelled appointment for the same slot if exists for THIS patient
            Appointment::where('patient_id', $patientProfile->id)
                ->where('doctor_id', $validated['doctor_id'])
                ->where('appointment_date', $validated['appointment_date'])
                ->where('appointment_time', $schedule->start_time)
                ->where('status', 'cancelled')
                ->delete();
            
            // Create appointment with queue number
            Appointment::create([
                'patient_id' => $patientProfile->id,
                'doctor_id' => $validated['doctor_id'],
                'schedule_id' => $validated['schedule_id'],
                'appointment_date' => $validated['appointment_date'],
                'appointment_time' => $schedule->start_time,
                'queue_number' => $bookedCount + 1,
                'symptoms' => $validated['symptoms'],
                'status' => 'pending',
            ]);
        });
        
        return redirect()->route('patient.dashboard')
            ->with('success', 'کاتەکەت بە سەرکەوتوویی گیرا! پزیشک زۆر زوو پشتڕاستی دەکاتەوە');
    }
}