<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $specializations = [
            [
                'name' => 'نەشتەرگەری گشتی',
                'description' => 'شارەزا لە نەشتەرگەرییە گشتییەکان و کۆئەندامی هەرەس.',
                'icon' => 'general_surgery.png',
            ],
            [
                'name' => 'بەشی مەمک',
                'description' => 'پشکنین و چارەسەری نەخۆشییەکانی مەمک و نەشتەرگەری جوانکاری.',
                'icon' => 'breast.png',
            ],
            [
                'name' => 'بەشی کۆم و ڕێچکە',
                'description' => 'چارەسەری نەخۆشییەکانی کۆم و ڕێچکە بە پێشکەوتووترین شێواز.',
                'icon' => 'colorectal.png',
            ],
            [
                'name' => 'نەشتەرگەری فتق و دیواری سک',
                'description' => 'پسپۆڕی لە نەشتەرگەری فتق و چاککردنەوەی دیواری سک.',
                'icon' => 'hernia.png',
            ],
            [
                'name' => 'بەشی هەناوی',
                'description' => 'چارەسەری نەخۆشییە ناوخۆییەکانی لەش.',
                'icon' => 'internal_medicine.png',
            ],
            [
                'name' => 'بەشی دڵ و دەمار',
                'description' => 'پشکنین و چارەسەری نەخۆشییەکانی دڵ و شاخوێنبەرەکان.',
                'icon' => 'cardiology.png',
            ],
        ];

        foreach ($specializations as $spec) {
            Specialization::create($spec);
        }
    }
}