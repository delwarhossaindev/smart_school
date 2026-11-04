<?php

namespace App\Http\Controllers;

use App\Legacy\Runtime;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * The "/" route. The old default_controller was chosen at runtime inside a patched
 * system/core/Router.php: the public website, or the login page when the website is disabled.
 */
class LegacyHome
{
    public function __invoke(): Response
    {
        $setting = DB::table('global_setting')->first();

        if (($setting->enable_frontend ?? 0) == 1) {
            return Runtime::run(Web\Web::class, 'index', [], 'web', 'web');
        }

        return redirect()->route('login');
    }
}
