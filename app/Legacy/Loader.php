<?php

namespace App\Legacy;

use App\Legacy\Database\Forge;
use App\Legacy\Database\Utility;
use Illuminate\Support\Facades\View;

class Loader
{
    private array $cachedVars = [];

    private array $viewPaths = [];

    private array $classes = [];

    private array $models = [];

    private array $helpers = [];

    private int $depth = 0;

    public function view($view, $vars = [], $return = false)
    {
        // CodeIgniter keeps view variables for the whole request, so a nested view
        // sees everything passed to any view rendered before it.
        $this->cachedVars = array_merge($this->cachedVars, is_object($vars) ? get_object_vars($vars) : (array) $vars);

        $path = $this->findView($view);

        if ($path === null) {
            show_error('Unable to load the requested file: '.$view.'.php');
        }

        $this->depth++;

        try {
            $html = View::file($path, $this->cachedVars)->render();
        } finally {
            $this->depth--;
        }

        if ($return) {
            return $html;
        }

        if ($this->depth > 0) {
            echo $html;
        } else {
            get_instance()->output->append_output($html);
        }

        return $this;
    }

    public function vars($vars, $value = '')
    {
        $this->cachedVars = array_merge($this->cachedVars, is_array($vars) ? $vars : [$vars => $value]);

        return $this;
    }

    public function model($model, $alias = null, $connect = false)
    {
        if (is_array($model)) {
            foreach ($model as $item) {
                $this->model($item);
            }

            return $this;
        }

        $alias = $alias ?: basename($model);

        if (in_array($alias, $this->models, true)) {
            return $this;
        }

        $class = $this->findModel($model);

        if ($class === null) {
            show_error('Unable to locate the model you have specified: '.$model);
        }

        get_instance()->{$alias} = new $class();
        $this->models[] = $alias;

        return $this;
    }

    public function library($library, $params = null, $alias = null)
    {
        if (is_array($library)) {
            foreach ($library as $item) {
                $this->library($item, $params);
            }

            return $this;
        }

        $key = strtolower(basename($library));

        if (isset($this->classes[$key])) {
            return $this;
        }

        $class = match ($key) {
            'form_validation' => CI_Form_validation::class,
            'email' => CI_Email::class,
            default => $this->findClass(app_path('Libraries'), 'App\\Libraries\\', $key),
        };

        if ($class === null) {
            show_error('Unable to load the requested class: '.$library);
        }

        $alias = $alias ? strtolower($alias) : $key;

        get_instance()->{$alias} = $params === null ? new $class() : new $class($params);
        $this->classes[$key] = $alias;

        return $this;
    }

    public function is_loaded($class)
    {
        return $this->classes[strtolower(basename($class))] ?? false;
    }

    public function helper($helpers = [])
    {
        foreach ((array) $helpers as $helper) {
            $helper = str_replace(['_helper', '.php'], '', strtolower($helper));

            if (! isset($this->helpers[$helper])) {
                $path = app_path('Legacy/helpers/'.$helper.'_helper.php');

                if (! is_file($path)) {
                    show_error('Unable to load the requested file: helpers/'.$helper.'_helper.php');
                }

                require_once $path;
                $this->helpers[$helper] = true;
            }
        }

        return $this;
    }

    public function dbforge()
    {
        get_instance()->dbforge = new Forge();

        return $this;
    }

    public function dbutil()
    {
        get_instance()->dbutil = new Utility();

        return $this;
    }

    /**
     * Same order as the HMVC loader: the current module, a module named by the first path
     * segment, then every directory a view was already found in during this request, most
     * recent first, and finally the shared views. Views rely on this: accounting/invoice/index
     * includes a plain 'invoice-modal' from its own directory.
     */
    private function findView(string $view): ?string
    {
        $view = str_ends_with($view, '.php') ? $view : $view.'.php';
        $root = resource_path('views/');
        $file = basename($view);
        $subpath = dirname($view) === '.' ? '' : dirname($view).'/';
        $module = get_instance()->router->fetch_module();

        $modulePaths = $module ? [$root.$module.'/'.$subpath] : [];

        if ($subpath !== '') {
            [$first, $rest] = explode('/', $subpath, 2);

            if (is_dir(app_path('Http/Controllers/'.ucfirst($first)))) {
                $modulePaths[] = $root.$first.'/'.$rest;
            }
        }

        foreach ($modulePaths as $path) {
            if (is_file($path.$file)) {
                unset($this->viewPaths[$path]);
                $this->viewPaths = [$path => true] + $this->viewPaths;

                return $path.$file;
            }
        }

        foreach (array_keys($this->viewPaths + [$root => true]) as $path) {
            if (is_file($path.$view)) {
                return $path.$view;
            }
        }

        return null;
    }

    private function findModel(string $model): ?string
    {
        $name = strtolower(basename($model));
        $parts = explode('/', $model);
        $modules = array_filter([count($parts) > 1 ? $parts[0] : null, get_instance()->router->fetch_module()]);

        foreach ($modules as $module) {
            $module = ucfirst($module);
            $class = $this->findClass(app_path('Models/'.$module), 'App\\Models\\'.$module.'\\', $name);

            if ($class !== null) {
                return $class;
            }
        }

        return $this->findClass(app_path('Models'), 'App\\Models\\', $name);
    }

    /**
     * Legacy code names classes in any letter case, so match them case-insensitively.
     */
    private function findClass(string $directory, string $namespace, string $lowerName): ?string
    {
        foreach (glob($directory.'/*.php') ?: [] as $file) {
            $name = basename($file, '.php');

            if (strtolower($name) === $lowerName) {
                return $namespace.$name;
            }
        }

        return null;
    }
}
