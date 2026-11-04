<?php

namespace App\Http\Controllers;

use App\Legacy\Runtime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

/**
 * The "/" route. The old default_controller was chosen at runtime inside a patched
 * system/core/Router.php: the purchase-code screen until a code is stored, then the public
 * website, or the login page when the website is disabled.
 */
class LegacyHome
{
    public function __invoke(): Response
    {
        $purchase = Schema::hasTable('purchase') ? DB::table('purchase')->first() : null;

        if (empty($purchase->purchase_code)) {
            return Runtime::run(Verify::class, 'index', [], null, 'verify');
        }

        $setting = DB::table('global_setting')->first();

        if (($setting->enable_frontend ?? 0) == 1) {
            return Runtime::run(Web\Web::class, 'index', [], 'web', 'web');
        }

        return Runtime::run(Welcome::class, 'index', [], null, 'welcome');
    }
}
