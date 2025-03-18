<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application's language.
     *
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchLang(string $locale): RedirectResponse
    {
        // Check if the locale is supported
        if (in_array($locale, ['en', 'id'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
