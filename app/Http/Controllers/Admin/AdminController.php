<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Specialization;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_doctors' => DoctorProfile::count(),
            'total_patients' => PatientProfile::count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_contacts' => Contact::count(),
            'new_contacts' => Contact::where('status', 'new')->count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recentContacts'));
    }
}