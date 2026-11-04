<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Every link in the application ends in ".html" (the old url_suffix setting), while the
 * routes are defined without it. Runs before routing and removes the suffix from the path.
 */
class StripUrlSuffix
{
    private const SUFFIX = '.html';

    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if (str_ends_with($path, self::SUFFIX)) {
            $uri = $request->server->get('REQUEST_URI');
            $parts = explode('?', $uri, 2);
            $parts[0] = substr($parts[0], 0, -strlen(self::SUFFIX));

            $request->server->set('REQUEST_URI', implode('?', $parts));
            $request->initialize(
                $request->query->all(),
                $request->request->all(),
                $request->attributes->all(),
                $request->cookies->all(),
                $request->files->all(),
                $request->server->all(),
                $request->getContent(),
            );
        }

        return $next($request);
    }
}
