<?php

namespace App\Http\Controllers;

use App\Legacy\Runtime;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Entry point for every route in routes/legacy.php. Controllers are created here rather
 * than by the router, because their constructors need the session, and the router would
 * instantiate them before the session middleware has run.
 */
class LegacyDispatcher
{
    public function __invoke(Request $request): Response
    {
        $route = $request->route();
        $target = $route->defaults['_ci'];

        return Runtime::run(
            $target['controller'],
            $target['method'],
            $this->arguments($route->parameters(), $target['args'] ?? null),
            $target['module'],
            $target['class'],
        );
    }

    private function arguments(array $parameters, ?array $template): array
    {
        if ($template !== null) {
            return array_map(
                fn ($arg) => preg_replace_callback('/\$(\d+)/', fn ($m) => $parameters['p'.$m[1]] ?? '', $arg),
                $template,
            );
        }

        return isset($parameters['args']) ? explode('/', trim($parameters['args'], '/')) : [];
    }
}
