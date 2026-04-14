<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Remove the unique constraint that limits one appointment per slot
            // Using explicit name to be sure
            $table->dropUnique('appointments_doctor_id_appointment_date_appointment_time_unique');
            
            // Add queue_number to track arrival order
            $table->integer('queue_number')->default(1)->after('appointment_time');
            
            // Add a more flexible unique constraint to prevent SAME PATIENT booking SAME DOCTOR at SAME TIME
            $table->unique(['patient_id', 'doctor_id', 'appointment_date', 'appointment_time'], 'unique_patient_appointment');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropUnique('unique_patient_appointment');
            $table->dropColumn('queue_number');
            $table->unique(['doctor_id', 'appointment_date', 'appointment_time']);
        });
    }
};
