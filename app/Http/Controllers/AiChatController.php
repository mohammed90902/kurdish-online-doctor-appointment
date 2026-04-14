<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $userMessage = $request->input('message');
        
        // Character Normalization for Kurdish/Arabic variations
        $msg = $userMessage;
        $msg = str_replace(['ي', 'ى'], 'ی', $msg); // Normalize Y
        $msg = str_replace('ك', 'ک', $msg); // Normalize K
        $msg = mb_strtolower($msg);
        
        // Safety Warning / Drug Filter
        $drugKeywords = [
            'دەرمان', 'حەب', 'شروب', 'paracetamol', 'panadol', 'amoxicillin', 'ibuprofen', 'aspirin', 
            'دەرزی', 'چارەسەری کیمیایی', 'antibiotic', 'medicine', 'drug', 'pill'
        ];

        foreach ($drugKeywords as $drug) {
            if (str_contains($msg, $drug)) {
                return response()->json([
                    'success' => true,
                    'reply' => __("AI Drug Warning")
                ]);
            }
        }

        $fallbackMessage = __("AI Fallback Message");

        // --- ENHANCED KNOWLEDGE BASE MAPPING (Keywords -> Topic Keys) ---
        $kbMap = [
            // Website Navigation & Account
            'ئەکاونت' => 'ai_account_info',
            'account' => 'ai_account_info',
            'حساب' => 'ai_account_info',
            'پاسۆرد' => 'ai_password_info',
            'password' => 'ai_password_info',
            'كلمة المرور' => 'ai_password_info',
            'کات' => 'ai_booking_info',
            'book' => 'ai_booking_info',
            'حجز' => 'ai_booking_info',
            'موعد' => 'ai_booking_info',
            'تۆمار' => 'ai_account_info',
            'register' => 'ai_account_info',
            'تسجيل' => 'ai_account_info',
            'سجل' => 'ai_account_info',
            'حساب' => 'ai_account_info',
            'login' => 'ai_profile_info',
            'دخول' => 'ai_profile_info',
            'داخل' => 'ai_profile_info',
            'search' => 'ai_search_info',
            'گەڕان' => 'ai_search_info',
            'بحث' => 'ai_search_info',
            'profile' => 'ai_profile_info',
            'پڕۆفایل' => 'ai_profile_info',
            'ملف' => 'ai_profile_info',
            'اسم' => 'ai_profile_info',

            // Body Parts & Health Issues
            'head' => 'ai_head_info',
            'سەر' => 'ai_head_info',
            'راس' => 'ai_head_info',
            'صداع' => 'ai_head_info',
            'وجع' => 'ai_head_info',
            'eye' => 'ai_eye_info',
            'چاو' => 'ai_eye_info',
            'عين' => 'ai_eye_info',
            'عيون' => 'ai_eye_info',
            'tooth' => 'ai_tooth_info',
            'ددان' => 'ai_tooth_info',
            'اسنان' => 'ai_tooth_info',
            'سن ' => 'ai_tooth_info',
            'throat' => 'ai_throat_info',
            'قوڕگ' => 'ai_throat_info',
            'حنجرة' => 'ai_throat_info',
            'بلعوم' => 'ai_throat_info',
            'chest' => 'ai_chest_info',
            'سینگ' => 'ai_chest_info',
            'صدر' => 'ai_chest_info',
            'heart' => 'ai_heart_info',
            'دڵ' => 'ai_heart_info',
            'قلب' => 'ai_heart_info',
            'back' => 'ai_back_info',
            'پشت' => 'ai_back_info',
            'ظهر' => 'ai_back_info',
            'stomach' => 'ai_stomach_info',
            'گەیە' => 'ai_stomach_info',
            'معدة' => 'ai_stomach_info',
            'بطن' => 'ai_stomach_info',
            'diet' => 'ai_diet_info',
            'سیم' => 'ai_diet_info',
            'نظام غذائي' => 'ai_diet_info',
            'اكل' => 'ai_diet_info',

            // Diseases & Symptoms
            'diabetes' => 'ai_diabetes_info',
            'شەکرە' => 'ai_diabetes_info',
            'سكر' => 'ai_diabetes_info',
            'سكري' => 'ai_diabetes_info',
            'pressure' => 'ai_pressure_info',
            'فشار' => 'ai_pressure_info',
            'ضغط' => 'ai_pressure_info',
            'تضغط' => 'ai_pressure_info',
            'cough' => 'ai_cough_info',
            'کۆکە' => 'ai_cough_info',
            'سعال' => 'ai_cough_info',
            'كحة' => 'ai_cough_info',
            'allergy' => 'ai_allergy_info',
            'حەساسییە' => 'ai_allergy_info',
            'حساسية' => 'ai_allergy_info',
            'flu' => 'ai_flu_info',
            'هەڵامەت' => 'ai_flu_info',
            'انفلونزا' => 'ai_flu_info',
            'زكام' => 'ai_flu_info',
            'نشلة' => 'ai_flu_info',
            'fever' => 'ai_fever_info',
            'تا ' => 'ai_fever_info',
            'حرارة' => 'ai_fever_info',
            'سخونة' => 'ai_fever_info',
            'covid' => 'ai_covid_info',
            'کۆڕۆنا' => 'ai_covid_info',
            'كورونا' => 'ai_covid_info',

            // General Info
            'who' => 'ai_who_info',
            'کێین' => 'ai_who_info',
            'من نحن' => 'ai_who_info',
            'contact' => 'ai_contact_info',
            'پەیوەندی' => 'ai_contact_info',
            'اتصال' => 'ai_contact_info',
        ];

        foreach ($kbMap as $keyword => $topicKey) {
            if (str_contains($msg, $keyword)) {
                return response()->json([
                    'success' => true,
                    'reply' => __($topicKey)
                ]);
            }
        }

        // --- GREETINGS ---
        $greetings = ['سڵاو', 'چۆنی', 'hello', 'hi', 'hey', 'مرحبا', 'اهلا', 'سلام'];
        foreach ($greetings as $greet) {
            if (str_contains($msg, $greet)) {
                return response()->json([
                    'success' => true, 
                    'reply' => __("AI Greeting Response")
                ]);
            }
        }

        // --- FINAL FALLBACK ---
        return response()->json([
            'success' => true,
            'reply' => $fallbackMessage
        ]);
    }
}
