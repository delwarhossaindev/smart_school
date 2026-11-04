<?php

namespace App\Legacy;

use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Renders a Blade page inside the legacy layout, whose header and menu still need the
 * legacy runtime. Once the layout itself is in Blade, this class can go.
 */
class LayoutHost extends MY_Controller
{
    public static function respond(string $title, View $view, string $module, string $class): Response
    {
        return Runtime::run(self::class, 'page', [$title, $view], $module, $class);
    }

    public function page(string $title, View $view): void
    {
        $this->layout->title($title.' | '.SMS);
        $this->layout->view('layout/blade-page', ['html' => $view->render()]);
    }
}
