<?php

$ckb = [
    'Please fix errors:' => 'تکایە هەڵەکان چاکبکەوە:',
    'Phone' => 'تەلەفۆن',
    'Note: Give this password to the doctor' => 'تێبینی: ئەم وشەی نهێنیە بە پزیشکەکە بدە',
    'Professional Info' => 'زانیاری پیشەیی',
    'Specialist' => 'پسپۆڕی',
    'Select Specialization' => 'پسپۆڕی هەڵبژێرە',
    'License Number' => 'ژمارەی مۆڵەت',
    'Experience Years' => 'ساڵانی ئەزموون',
    'Consultation Fee (IQD)' => 'کرێی چاوپێکەوتن (IQD)',
    'Qualifications' => 'بڕوانامەکان',
    'Doctor qualifications short...' => 'بڕوانامەکانی پزیشک بە کورتی...',
    'Bio (Optional)' => 'باسی کەسی (ئارەزوومەندانە)',
    'Short bio about doctor...' => 'کورتەیەک دەربارەی پزیشک...',
    'Doctor Profile Image (Optional)' => 'وێنەی پزیشک (ئارەزوومەندانە)',
    'Cancel' => 'هەڵوەشاندنەوە'
];

$ar = [
    'Please fix errors:' => 'الرجاء تصحيح الأخطاء:',
    'Phone' => 'رقم الهاتف',
    'Note: Give this password to the doctor' => 'ملاحظة: أعط كلمة المرور هذه للطبيب',
    'Professional Info' => 'المعلومات المهنية',
    'Specialist' => 'التخصص',
    'Select Specialization' => 'اختر التخصص',
    'License Number' => 'رقم الترخيص',
    'Experience Years' => 'سنوات الخبرة',
    'Consultation Fee (IQD)' => 'أجور المعاينة (د.ع)',
    'Qualifications' => 'المؤهلات',
    'Doctor qualifications short...' => 'مؤهلات الطبيب باختصار...',
    'Bio (Optional)' => 'نبذة شخصية (اختياري)',
    'Short bio about doctor...' => 'نبذة قصيرة عن الطبيب...',
    'Doctor Profile Image (Optional)' => 'صورة شخصية (اختياري)',
    'Cancel' => 'إلغاء'
];

$en = [];
foreach(array_keys($ckb) as $k) {
    $en[$k] = $k;
}

foreach (['ckb' => $ckb, 'ar' => $ar, 'en' => $en] as $lang => $trans) {
    $file = __DIR__ . "/resources/lang/$lang.json";
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true) ?: [];
        foreach ($trans as $key => $val) {
            $data[$key] = $val;
        }
        file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}

echo "Added more form langs";
