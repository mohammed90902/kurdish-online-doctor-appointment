<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PatientProfile;
use App\Models\DoctorProfile;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '07501234567',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create 5 Doctors
        for ($i = 1; $i <= 5; $i++) {
            $doctor = User::create([
                'name' => 'Dr. Doctor ' . $i,
                'email' => 'doctor' . $i . '@example.com',
                'password' => Hash::make('password'),
                'phone' => '0750123456' . $i,
                'role' => 'doctor',
                'email_verified_at' => now(),
            ]);

            DoctorProfile::create([
                'user_id' => $doctor->id,
                'specialization_id' => rand(1, 6),
                'license_number' => 'LIC-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'experience_years' => rand(2, 20),
                'consultation_fee' => rand(20, 100) * 1000,
                'qualifications' => 'MBBS, MD',
                'bio' => 'Experienced doctor with ' . rand(2, 20) . ' years of practice.',
                'status' => 'approved',
            ]);
        }

        // Create 10 Patients
        for ($i = 1; $i <= 10; $i++) {
            $patient = User::create([
                'name' => 'Patient ' . $i,
                'email' => 'patient' . $i . '@example.com',
                'password' => Hash::make('password'),
                'phone' => '0770123456' . $i,
                'role' => 'patient',
                'email_verified_at' => now(),
            ]);

            PatientProfile::create([
                'user_id' => $patient->id,
                'date_of_birth' => now()->subYears(rand(20, 60))->format('Y-m-d'),
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'blood_group' => ['A+', 'B+', 'O+', 'AB+'][rand(0, 3)],
                'address' => 'Sulaymaniyah, Kurdistan',
                'medical_history' => 'No major medical issues.',
            ]);
        }
    }
}