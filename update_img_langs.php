<?php

$ckb = [
    'Click to upload image' => 'کلیک بکە بۆ بارکردنی وێنە',
    'PNG, JPG under 2MB' => 'PNG, JPG بە قەبارەی کەمتر لە ٢ مێگابایت'
];

$ar = [
    'Click to upload image' => 'انقر هنا لرفع الصورة',
    'PNG, JPG under 2MB' => 'PNG, JPG بحجم أقل من 2 ميغابايت'
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

echo "Added image keys";
