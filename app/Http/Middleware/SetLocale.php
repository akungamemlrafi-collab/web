<?php

namespace App\Http\Middleware;

Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Get locale from session, query string, or default to 'id'
        $locale = session('locale') ?: request('lang') ?: config('app.locale');

        // Only allow 'id' or 'en'
        if (!in_array($locale, ['id', 'en'])) {
            $locale = 'id';
        }

        // Set the locale
        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}
