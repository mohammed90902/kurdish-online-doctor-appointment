<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting schema repair...\n";

// 1. Fix doctor_schedules table
if (!Schema::hasColumn('doctor_schedules', 'max_patients')) {
    Schema::table('doctor_schedules', function (Blueprint $table) {
        $table->integer('max_patients')->default(1)->after('slot_duration');
    });
    echo "Added 'max_patients' to 'doctor_schedules'.\n";
} else {
    echo "'max_patients' already exists in 'doctor_schedules'.\n";
}

// 2. Fix appointments table
if (!Schema::hasColumn('appointments', 'queue_number')) {
    Schema::table('appointments', function (Blueprint $table) {
        // Try to drop unique constraint if it exists
        try {
            // Using raw SQL to be safe as Laravel name might differ
            DB::statement('ALTER TABLE appointments DROP INDEX appointments_doctor_id_appointment_date_appointment_time_unique');
            echo "Dropped old unique index.\n";
        } catch (\Exception $e) {
            echo "Note: Could not drop index via name 1, trying column-based drop or skipping...\n";
            try {
                $table->dropUnique(['doctor_id', 'appointment_date', 'appointment_time']);
                echo "Dropped old unique index via column list.\n";
            } catch (\Exception $e2) {
                echo "Note: Index might already be gone.\n";
            }
        }

        $table->integer('queue_number')->default(1)->after('appointment_time');
        $table->unique(['patient_id', 'doctor_id', 'appointment_date', 'appointment_time'], 'unique_patient_appointment');
    });
    echo "Added 'queue_number' and new unique index to 'appointments'.\n";
} else {
    echo "'queue_number' already exists in 'appointments'.\n";
}

// 3. Mark migrations as done so artisan migrate doesn't freak out
DB::table('migrations')->updateOrInsert(
    ['migration' => '2026_01_31_000001_add_max_patients_to_doctor_schedules'],
    ['batch' => 99]
);
DB::table('migrations')->updateOrInsert(
    ['migration' => '2026_01_31_000002_update_appointments_table_for_multi_patient'],
    ['batch' => 99]
);

echo "Schema repair complete!\n";
