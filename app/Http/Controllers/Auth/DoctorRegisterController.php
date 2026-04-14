<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class DoctorRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $specializations = Specialization::all();
        return view('auth.doctor-register', compact('specializations'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name_ku' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'name_en' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
            // Create user
            $user = User::create([
                'name' => $request->name_ku,
                'name_ku' => $request->name_ku,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
            ]);

            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('doctors', 'public');
            }

            // Create doctor profile
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

            return redirect()->route('login')->with('success', 'تۆمارکردنەکەت سەرکەوتووبوو! ئێستا دەتوانیت بچیتە ژوورەوە.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'هەڵەیەک ڕوویدا. تکایە دووبارە هەوڵ بدەوە.'])->withInput();
        }
    }
}