<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctor = Auth::user()->doctorProfile;

        // Ensure doctor profile exists
        if (!$doctor) {
            abort(404, 'Doctor profile not found.');
        }

        $stats = [
            'total_appointments' => $doctor->appointments()->count(),
            'today_appointments' => $doctor->appointments()
                ->whereDate('appointment_date', today())
                ->count(),
            'pending_appointments' => $doctor->appointments()
                ->where('status', 'pending')
                ->count(),
            'completed_appointments' => $doctor->appointments()
                ->where('status', 'completed')
                ->count(),
            'total_schedules' => $doctor->schedules()->count(),
        ];

        // Today's appointments
        $todayAppointments = $doctor->appointments()
            ->with(['patient.user'])
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        // Upcoming appointments
        $upcomingAppointments = $doctor->appointments()
            ->with(['patient.user'])
            ->where('appointment_date', '>=', today())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact('stats', 'todayAppointments', 'upcomingAppointments', 'doctor'));
    }
}