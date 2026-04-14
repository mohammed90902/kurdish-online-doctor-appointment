<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Starting final repair...\n";

try {
    DB::statement('ALTER TABLE appointments DROP INDEX appointments_doctor_id_appointment_date_appointment_time_unique');
    echo "Dropped old unique index.\n";
} catch (\Exception $e) {
    echo "Old index already gone or missing: " . $e->getMessage() . "\n";
}

Schema::table('appointments', function (Blueprint $table) {
    if (!Schema::hasColumn('appointments', 'queue_number')) {
        $table->integer('queue_number')->default(1)->after('appointment_time');
        echo "Added 'queue_number'.\n";
    } else {
        echo "'queue_number' already exists.\n";
    }
});

try {
    Schema::table('appointments', function (Blueprint $table) {
        $table->unique(['patient_id', 'doctor_id', 'appointment_date', 'appointment_time'], 'unique_patient_appointment');
        echo "Added new unique index.\n";
    });
} catch (\Exception $e) {
    echo "New unique index error (likely already exists): " . $e->getMessage() . "\n";
}

DB::table('migrations')->updateOrInsert(
    ['migration' => '2026_01_31_000002_update_appointments_table_for_multi_patient'],
    ['batch' => 99]
);

echo "Repair finished!\n";
