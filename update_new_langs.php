<?php
$ckb = [
    'Phone Number' => 'ژمارەی تەلەفۆن',
    'Password' => 'وشەی نهێنی',
    'Confirm Password' => 'دووبارەکردنەوەی وشەی نهێنی',
    'Save Admin' => 'تۆمارکردنی ئەدمین',
    'Enter full name' => 'ناوی تەواو بنووسە',
    'Back to Admins' => 'گەڕانەوە بۆ لیستی ئەدمینەکان',
    'User Information' => 'زانیاری بەکارهێنەر',
    'Minimum 8 characters' => 'لانی کەم ٨ پیت',
    'Back to Doctors' => 'گەڕانەوە بۆ لیستی پزیشکان',
    'Save Doctor' => 'تۆمارکردنی پزیشک',
    'Publish New Post' => 'بڵاوکردنەوەی پۆستی نوێ',
    'Kurdish (Main)' => 'کوردی (سەرەکی)',
    'Arabic' => 'عەرەبی',
    'English' => 'English',
    'Post Title (Kurdish)' => 'ناونیشانی پۆست (کوردی)',
    'Post Title (Arabic)' => 'ناونیشانی پۆست (عەرەبی)',
    'Post Title (English)' => 'ناونیشانی پۆست (ئینگلیزی)',
    'Post Content (Kurdish)' => 'ناوەڕۆکی پۆست (کوردی)',
    'Post Content (Arabic)' => 'ناوەڕۆکی پۆست (عەرەبی)',
    'Post Content (English)' => 'ناوەڕۆکی پۆست (ئینگلیزی)',
    'Example for users' => 'بۆ نموونە: ئاگادارییەکی گرینگ بۆ هەموو بەکارهێنەران',
    'Write info here' => 'لێرە زانیارییەکان یان دەقی ئاگادارییەکە بنووسە...',
    'Post Image' => 'وێنەی پۆست',
    'Save Post' => 'بڵاوکردنەوەی پۆست',
    'Back to Dashboard' => 'گەڕانەوە بۆ داشبۆرد',
    'Section Name (Kurdish)' => 'ناوی بەش (کوردی)',
    'Section Name (Arabic)' => 'ناوی بەش (عەرەبی)',
    'Section Name (English)' => 'ناوی بەش (ئینگلیزی)',
    'Description (Kurdish)' => 'وەسف یان تێبینی (کوردی)',
    'Description (Arabic)' => 'وەسف یان تێبینی (عەرەبی)',
    'Description (English)' => 'وەسف یان تێبینی (ئینگلیزی)',
    'Section Image' => 'وێنەی بەش',
    'Save Section' => 'زیادکردنی بەش',
    'Back to Sections' => 'گەڕانەوە بۆ لیستی بەشەکان',
    'Example: Eye Section' => 'بۆ نموونە: بەشی چاو',
    'Write note here' => 'لێرە بنووسە...',
    'Section Information' => 'زانیاری بەشی نوێ',
    'Please fill info carefully' => 'تکایە زانیارییەکان بە وردی پڕ بکەرەوە',
    'Publish Post Note' => 'پۆستەکەت لە لاپەڕەی سەرەکی نیشان دەدرێت'
];

$ar = [
    'Phone Number' => 'رقم الهاتف',
    'Password' => 'كلمة المرور',
    'Confirm Password' => 'تأكيد كلمة المرور',
    'Save Admin' => 'حفظ المشرف',
    'Enter full name' => 'اكتب الاسم الكامل',
    'Back to Admins' => 'العودة لقائمة المشرفين',
    'User Information' => 'معلومات المستخدم',
    'Minimum 8 characters' => '8 أحرف على الأقل',
    'Back to Doctors' => 'العودة لقائمة الأطباء',
    'Save Doctor' => 'حفظ الطبيب',
    'Publish New Post' => 'نشر مقال جديد',
    'Kurdish (Main)' => 'الكردية (الرئيسية)',
    'Arabic' => 'العربية',
    'English' => 'English',
    'Post Title (Kurdish)' => 'عنوان المقال (كردي)',
    'Post Title (Arabic)' => 'عنوان المقال (عربي)',
    'Post Title (English)' => 'عنوان المقال (إنكليزي)',
    'Post Content (Kurdish)' => 'محتوى المقال (كردي)',
    'Post Content (Arabic)' => 'محتوى المقال (عربي)',
    'Post Content (English)' => 'محتوى المقال (إنكليزي)',
    'Example for users' => 'على سبيل المثال: إشعار مهم',
    'Write info here' => 'اكتب التفاصيل هنا...',
    'Post Image' => 'صورة المقال',
    'Save Post' => 'نشر المقال',
    'Section Name (Kurdish)' => 'اسم القسم (كردي)',
    'Section Name (Arabic)' => 'اسم القسم (عربي)',
    'Section Name (English)' => 'اسم القسم (إنكليزي)',
    'Description (Kurdish)' => 'الوصف (كردي)',
    'Description (Arabic)' => 'الوصف (عربي)',
    'Description (English)' => 'الوصف (إنكليزي)',
    'Section Image' => 'صورة القسم',
    'Save Section' => 'إضافة قسم',
    'Back to Sections' => 'العودة للأقسام',
    'Example: Eye Section' => 'مثل: قسم العيون',
    'Write note here' => 'اكتب هنا...',
    'Section Information' => 'معلومات القسم الجديد',
    'Please fill info carefully' => 'الرجاء كتابة المعلومات بدقة',
    'Publish Post Note' => 'ستظهر مقالتك في الصفحة الرئيسية'
];

foreach (['ckb' => $ckb, 'ar' => $ar] as $lang => $trans) {
    $file = __DIR__ . "/resources/lang/$lang.json";
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true) ?: [];
        foreach ($trans as $key => $val) {
            $data[$key] = $val;
        }
        file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}

echo "Added create form langs";
