<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateSpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $translations = [
            'Cardiology' => ['name' => 'بەشی دڵ و دەمار', 'icon' => 'cardiology.png'],
            'Dermatology' => ['name' => 'بەشی پێست', 'icon' => 'dermatology.png'],
            'Pediatrics' => ['name' => 'بەشی منداڵان', 'icon' => 'pediatrics.png'],
            'Orthopedics' => ['name' => 'بەشی ئێسک و جومگە', 'icon' => 'orthopedics.png'],
            'Neurology' => ['name' => 'بەشی دەمار', 'icon' => 'neurology.png'],
            'General Medicine' => ['name' => 'بەشی گشتی', 'icon' => 'general_medicine.png'],
        ];

        foreach ($translations as $old => $new) {
            \App\Models\Specialization::where('name', $old)->update($new);
        }

        $extras = [
            ['name' => 'بەشی مەمک', 'description' => 'پشکنین و چارەسەری نەخۆشییەکانی مەمک و نەشتەرگەری جوانکاری.', 'icon' => 'breast.png'],
            ['name' => 'بەشی کۆم و ڕێچکە', 'description' => 'چارەرسەری نەخۆشییەکانی کۆم و ڕێچکە بە پێشکەوتووترین شێواز.', 'icon' => 'colorectal.png'],
            ['name' => 'نەشتەرگەری فتق و دیواری سک', 'description' => 'پسپۆڕی لە نەشتەرگەری فتق و چاککردنەوەی دیواری سک.', 'icon' => 'hernia.png'],
        ];

        foreach ($extras as $extra) {
            if (!\App\Models\Specialization::where('name', $extra['name'])->exists()) {
                \App\Models\Specialization::create($extra);
            }
        }
    }
}
