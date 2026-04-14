<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $specializations = [];
        if ($request->user()->isDoctor()) {
            $specializations = Specialization::all();
        }

        return view('profile.edit', [
            'user' => $request->user(),
            'specializations' => $specializations,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        // Sync primary name with Kurdish name
        if ($request->has('name_ku')) {
            $user->name = $request->name_ku;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Handle Doctor Profile Update
        if ($user->isDoctor()) {
            $doctorProfile = $user->doctorProfile;
            if ($doctorProfile) {
                $profileData = $request->only([
                    'specialization_id',
                    'experience_years',
                    'consultation_fee',
                    'qualifications',
                    'bio'
                ]);

                if ($request->hasFile('profile_image')) {
                    // Delete old image if exists
                    if ($doctorProfile->profile_image) {
                        Storage::disk('public')->delete($doctorProfile->profile_image);
                    }
                    $path = $request->file('profile_image')->store('doctor_profiles', 'public');
                    $profileData['profile_image'] = $path;
                }

                $doctorProfile->update($profileData);
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
