<?php
$ckb = [
    'Edit Section' => 'دەستکاریکردنی بەشی',
    'Edit Information' => 'دەستکاریکردنی زانیارییەکان',
    'Updating info for section' => 'بەرەوپێشبردنی زانیارییەکانی بەشی',
    'Change Image' => 'گۆڕینی وێنە',
    'Update Section' => 'نوێکردنەوەی بەش'
];

$ar = [
    'Edit Section' => 'تعديل قسم',
    'Edit Information' => 'تعديل المعلومات',
    'Updating info for section' => 'تحديث معلومات القسم',
    'Change Image' => 'تغيير الصورة',
    'Update Section' => 'تحديث القسم'
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
echo "Added Edit translations";
