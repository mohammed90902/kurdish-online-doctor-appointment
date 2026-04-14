<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorManagementController extends Controller
{
    public function index()
    {
        $doctors = DoctorProfile::with(['user', 'specialization'])
            ->latest()
            ->paginate(10);

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $specializations = Specialization::all();
        return view('admin.doctors.create', compact('specializations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ku' => ['required', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8'],
            'specialization_id' => ['required', 'exists:specializations,id'],
            'license_number' => ['required', 'string', 'max:50', 'unique:doctor_profiles'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'consultation_fee' => ['required', 'numeric', 'min:0'],
            'qualifications' => ['required', 'string'],
            'bio' => ['nullable', 'string'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name_ku,
                'name_ku' => $request->name_ku,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
                'email_verified_at' => now(),
            ]);

            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('doctors', 'public');
            }

            DoctorProfile::create([
                'user_id' => $user->id,
                'specialization_id' => $request->specialization_id,
                'license_number' => $request->license_number,
                'experience_years' => $request->experience_years,
                'consultation_fee' => $request->consultation_fee,
                'qualifications' => $request->qualifications,
                'bio' => $request->bio,
                'profile_image' => $profileImagePath,
                'status' => 'approved',
            ]);

            DB::commit();

            return redirect()->route('admin.doctors.index')->with('success', 'پزیشک بە سەرکەوتوویی زیادکرا');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'هەڵەیەک ڕوویدا. تکایە دووبارە هەوڵ بدەوە.'])->withInput();
        }
    }

    public function show($id)
    {
        $doctor = DoctorProfile::with(['user', 'specialization', 'schedules', 'appointments'])
            ->findOrFail($id);

        return view('admin.doctors.show', compact('doctor'));
    }

    public function approve($id)
    {
        return $this->updateProfileStatus(DoctorProfile::findOrFail($id), 'approved', 'پزیشک پەسەندکرا');
    }

    public function reject($id)
    {
        return $this->updateProfileStatus(DoctorProfile::findOrFail($id), 'rejected', 'پزیشک ڕەتکرایەوە');
    }

    public function suspend($id)
    {
        return $this->updateProfileStatus(DoctorProfile::findOrFail($id), 'suspended', 'پزیشک ڕاگیرا');
    }

    public function activate($id)
    {
        return $this->updateProfileStatus(DoctorProfile::findOrFail($id), 'approved', 'پزیشک چالاککرایەوە');
    }

    public function destroy($id)
    {
        return $this->deleteProfileWithUser(DoctorProfile::findOrFail($id), 'admin.doctors.index', 'پزیشک سڕایەوە');
    }

    protected function updateProfileStatus($profile, $status, $message)
    {
        $profile->update(['status' => $status]);
        return back()->with('success', $message);
    }

    protected function deleteProfileWithUser($profile, $redirectRoute, $message)
    {
        $user = $profile->user;
        
        if (isset($profile->profile_image) && $profile->profile_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->profile_image);
        }
        
        $profile->delete();
        
        if ($user) {
            $user->delete();
        }

        return redirect()->route($redirectRoute)->with('success', $message);
    }
}