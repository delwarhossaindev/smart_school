<?php

namespace App\Legacy;

use Illuminate\View\Engines\PhpEngine;
use Throwable;

/**
 * Laravel's PhpEngine runs ltrim() on every rendered view. The views are nested, so that
 * would change the whitespace of the final HTML compared to CodeIgniter's loader.
 */
class PhpViewEngine extends PhpEngine
{
    protected function evaluatePath($path, $data)
    {
        $obLevel = ob_get_level();

        ob_start();

        try {
            $this->files->getRequire($path, $data);
        } catch (Throwable $e) {
            $this->handleViewException($e, $obLevel);
        }

        return ob_get_clean();
    }
}
