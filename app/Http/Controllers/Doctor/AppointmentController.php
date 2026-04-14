<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctorProfile;

        $appointments = $doctor->appointments()
            ->with(['patient.user'])
            ->latest('appointment_date')
            ->latest('appointment_time')
            ->paginate(15);

        return view('doctor.appointments.index', compact('appointments'));
    }

    public function show($id)
    {
        $doctor = Auth::user()->doctorProfile;

        $appointment = $doctor->appointments()
            ->with(['patient.user', 'patient', 'history.changedByUser'])
            ->findOrFail($id);

        return view('doctor.appointments.show', compact('appointment'));
    }

    public function confirm($id)
    {
        $doctor = Auth::user()->doctorProfile;
        $appointment = $doctor->appointments()->findOrFail($id);

        if ($appointment->isPending()) {
            $appointment->recordStatusChange('confirmed', Auth::id(), 'پزیشک پشتڕاستی کردەوە');
            return redirect()->back()->with('success', 'کاتەکە پشتڕاستکرایەوە');
        }

        return redirect()->back()->withErrors(['error' => 'ناتوانرێت ئەم کاتە پشتڕاست بکرێتەوە']);
    }

    public function complete(Request $request, $id)
    {
        $doctor = Auth::user()->doctorProfile;
        $appointment = $doctor->appointments()->findOrFail($id);

        if (!in_array($appointment->status, ['pending', 'confirmed'])) {
            return redirect()->back()->withErrors(['error' => 'ناتوانرێت ئەم کاتە تەواو بکرێت']);
        }

        $request->validate([
            'diagnosis' => 'required|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $appointment->update([
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'notes' => $request->notes,
        ]);

        $appointment->recordStatusChange('completed', Auth::id(), 'پزیشک کاتەکەی تەواوکرد');

        return redirect()->back()->with('success', 'کاتەکە تەواوکرا');
    }

    public function cancel(Request $request, $id)
    {
        $doctor = Auth::user()->doctorProfile;
        $appointment = $doctor->appointments()->findOrFail($id);

        if (!$appointment->canBeCancelled()) {
            return redirect()->back()->withErrors(['error' => 'ناتوانرێت ئەم کاتە هەڵبوەشێنرێتەوە']);
        }

        $request->validate([
            'reason' => 'required|string',
        ]);

        $appointment->recordStatusChange('cancelled', Auth::id(), $request->reason);

        return redirect()->back()->with('success', 'کاتەکە هەڵوەشایەوە');
    }
}