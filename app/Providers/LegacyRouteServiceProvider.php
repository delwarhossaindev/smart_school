<?php

namespace App\Providers;

use App\Http\Controllers\LegacyDispatcher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LegacyRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /*
         * Registers the routes of one controller: "{$prefix}" for its index, and
         * "{$prefix}/{method}/{args?}" for each action. Extra URI segments are passed
         * to the action as positional arguments, as CodeIgniter did.
         */
        Route::macro('ci', function (string $prefix, string $controller, array $methods, ?string $module, string $class) {
            $target = fn (string $method) => ['controller' => $controller, 'method' => $method, 'module' => $module, 'class' => $class];

            if (in_array('index', $methods, true)) {
                Route::any($prefix, LegacyDispatcher::class)->defaults('_ci', $target('index'));
            }

            foreach ($methods as $method) {
                Route::any($prefix.'/'.$method.'/{args?}', LegacyDispatcher::class)
                    ->where('args', '.*')
                    ->defaults('_ci', $target($method));
            }
        });

        /*
         * Registers one entry of the old config/routes.php. (:any) and (:num) become the
         * parameters p1, p2, ... which $1, $2, ... in the target refer to.
         */
        Route::macro('ciCustom', function (string $pattern, string $controller, string $method, array $args, ?string $module, string $class) {
            $n = 0;
            $wheres = [];

            $uri = preg_replace_callback('/\(:(any|num)\)/', function ($match) use (&$n, &$wheres) {
                $wheres['p'.++$n] = $match[1] === 'num' ? '[0-9]+' : '[^/]+';

                return '{p'.$n.'}';
            }, $pattern);

            Route::any($uri, LegacyDispatcher::class)
                ->where($wheres)
                ->defaults('_ci', compact('controller', 'method', 'module', 'class', 'args'));
        });
    }
}
