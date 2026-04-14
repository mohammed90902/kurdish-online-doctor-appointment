<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch language and store in session.
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch($locale)
    {
        $allowed = ['ckb', 'ar', 'en'];
        
        if (in_array($locale, $allowed)) {
            Session::put('locale', $locale);
            // Store locale in cookie for 30 days
            return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
        }

        return redirect()->back();
    }
}
