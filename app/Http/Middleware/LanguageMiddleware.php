<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if a language is stored in the session
        if (Session::has('locale')) {
            $locale = Session::get('locale');

            // Verify the locale is in the list of available languages
            $availableLanguages = ['en', 'id'];
            if (in_array($locale, $availableLanguages)) {
                App::setLocale($locale);
            }
        }

        return $next($request);
    }
}
