<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Http\Request;

class PatientManagementController extends Controller
{
    public function index()
    {
        $patients = PatientProfile::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.patients.index', compact('patients'));
    }

    public function show($id)
    {
        $patient = PatientProfile::with(['user', 'appointments.doctor.user'])
            ->findOrFail($id);

        return view('admin.patients.show', compact('patient'));
    }

    public function destroy($id)
    {
        $patient = PatientProfile::findOrFail($id);
        $user = $patient->user;
        
        $patient->delete();
        $user->delete();

        return redirect()->route('admin.patients.index')->with('success', 'نەخۆش سڕایەوە');
    }
}