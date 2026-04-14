<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function dashboard()
    {
        $patient = Auth::user();
        
        // Get patient_profile.id from user.id
        $patientProfile = DB::table('patient_profiles')
            ->where('user_id', $patient->id)
            ->first();
        
        if (!$patientProfile) {
            return view('patient.dashboard', [
                'patient' => $patient,
                'stats' => [
                    'total_appointments' => 0,
                    'upcoming_appointments' => 0,
                    'pending_appointments' => 0,
                    'completed_appointments' => 0,
                ],
                'upcomingAppointments' => collect([]),
                'recentAppointments' => collect([]),
            ]);
        }
        
        // Get patient's appointments using patient_profile.id
        $appointments = Appointment::where('patient_id', $patientProfile->id)
            ->with(['doctor.user', 'schedule'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();
        
        // Statistics
        $stats = [
            'total_appointments' => $appointments->count(),
            'upcoming_appointments' => $appointments->where('status', 'confirmed')
                ->where('appointment_date', '>=', now()->format('Y-m-d'))
                ->count(),
            'pending_appointments' => $appointments->where('status', 'pending')->count(),
            'completed_appointments' => $appointments->where('status', 'completed')->count(),
        ];
        
        // Upcoming appointments
        $upcomingAppointments = $appointments
            ->where('status', '!=', 'cancelled')
            ->where('status', '!=', 'completed')
            ->where('appointment_date', '>=', now()->format('Y-m-d'))
            ->take(5);
        
        // Recent appointments
        $recentAppointments = $appointments->take(10);
        
        return view('patient.dashboard', compact('patient', 'stats', 'upcomingAppointments', 'recentAppointments'));
    }
    
    public function doctors()
    {
        $doctors = \App\Models\DoctorProfile::approved()
            ->with(['user', 'specialization'])
            ->paginate(12);
        
        return view('patient.doctors', compact('doctors'));
    }
    
    // View single appointment details
    public function viewAppointment($id)
    {
        $patient = Auth::user();
        
        $patientProfile = $patient->patientProfile;
        
        if (!$patientProfile) {
            return redirect()->route('patient.dashboard')->with('error', 'پرۆفایلی نەخۆش نەدۆزرایەوە');
        }
        
        $appointment = Appointment::where('id', $id)
            ->where('patient_id', $patientProfile->id)
            ->with(['doctor.user', 'schedule'])
            ->firstOrFail();
        
        $doctor = $appointment->doctor; // This is a DoctorProfile model
        
        return view('patient.appointment-details', compact('appointment', 'doctor'));
    }
}