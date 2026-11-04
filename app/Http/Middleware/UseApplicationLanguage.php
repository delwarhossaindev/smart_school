<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Loads the language chosen in the settings, so __('login') works in Blade. The strings
 * live in lang/english/{language}_lang.php, which the legacy modules read as well.
 * Also shares the global settings with the views.
 */
class UseApplicationLanguage
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $setting = DB::table('global_setting')->where('status', 1)->first();
        } catch (QueryException) {
            $setting = null;
        }

        View::share('setting', $setting);

        $this->load(preg_replace('/\W/', '', $setting->language ?? '') ?: 'english');

        return $next($request);
    }

    private function load(string $language): void
    {
        $path = base_path("lang/english/{$language}_lang.php");
        $lang = [];

        if (is_file($path)) {
            include $path;
        }

        $lines = [];

        foreach ($lang as $key => $line) {
            $lines['*.'.$key] = $line;
        }

        app('translator')->addLines($lines, app()->getLocale());
    }
}
