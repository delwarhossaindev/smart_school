<?php

use App\Legacy\CI_Controller;
use App\Legacy\Halt;
use App\Legacy\Runtime;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

if (! function_exists('get_instance')) {
    function &get_instance()
    {
        return CI_Controller::get_instance();
    }
}

if (! function_exists('ci')) {
    function ci()
    {
        return CI_Controller::get_instance();
    }
}

if (! function_exists('lang')) {
    function lang($line)
    {
        return Runtime::$services['lang']->line($line);
    }
}

if (! function_exists('ci_exit')) {
    /**
     * Stands in for exit/die in the migrated code.
     */
    function ci_exit($status = '')
    {
        throw Runtime::halt(is_string($status) ? $status : '');
    }
}

if (! function_exists('ci_redirect')) {
    /**
     * CodeIgniter's redirect(). Renamed because Laravel already defines redirect().
     */
    function ci_redirect($uri = '', $method = 'auto', $code = null)
    {
        if (! preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = site_url($uri);
        }

        if ($method === 'refresh') {
            throw new Halt('', new Response('', 200, ['Refresh' => '0;url='.$uri]));
        }

        if (! is_numeric($code)) {
            $code = ($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'GET' ? 303 : 307;
        }

        throw new Halt('', new Response('', (int) $code, ['Location' => $uri]));
    }
}

if (! function_exists('show_error')) {
    function show_error($message, $statusCode = 500, $heading = 'An Error Was Encountered')
    {
        $message = '<p>'.implode('</p><p>', (array) $message).'</p>';

        throw new Halt('', new Response(view('errors.legacy', compact('heading', 'message'))->render(), $statusCode));
    }
}

if (! function_exists('show_404')) {
    function show_404($page = '', $logError = true)
    {
        abort(404);
    }
}

if (! function_exists('force_download')) {
    function force_download($filename = '', $data = '', $setMime = false)
    {
        if ($filename === '' || $data === '') {
            return;
        }

        if ($data === null) {
            if (! is_file($filename) || ($data = file_get_contents($filename)) === false) {
                return;
            }
            $filename = basename(str_replace('\\', '/', $filename));
        }

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $mimes = get_mimes();
        $mime = (array) ($mimes[$extension] ?? 'application/octet-stream');

        throw new Halt('', new Response($data, 200, [
            'Content-Type' => $mime[0],
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Expires' => '0',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length' => strlen($data),
            'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
        ]));
    }
}

if (! function_exists('log_message')) {
    function log_message($level, $message)
    {
        if ($level === 'error') {
            Log::error($message);
        }
    }
}

if (! function_exists('config_item')) {
    function config_item($item)
    {
        return Runtime::$services['config']->item($item);
    }
}

if (! function_exists('is_php')) {
    function is_php($version)
    {
        return version_compare(PHP_VERSION, $version, '>=');
    }
}

if (! function_exists('is_really_writable')) {
    function is_really_writable($file)
    {
        return is_writable($file);
    }
}

if (! function_exists('get_mimes')) {
    function &get_mimes()
    {
        static $mimes;

        if ($mimes === null) {
            $mimes = require __DIR__.'/mimes.php';
        }

        return $mimes;
    }
}

if (! function_exists('html_escape')) {
    function html_escape($var, $doubleEncode = true)
    {
        if (empty($var)) {
            return $var;
        }

        if (is_array($var)) {
            foreach (array_keys($var) as $key) {
                $var[$key] = html_escape($var[$key], $doubleEncode);
            }

            return $var;
        }

        return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', $doubleEncode);
    }
}

if (! function_exists('remove_invisible_characters')) {
    function remove_invisible_characters($str, $urlEncoded = true)
    {
        $nonDisplayables = [];

        if ($urlEncoded) {
            $nonDisplayables[] = '/%0[0-8bcef]/i';
            $nonDisplayables[] = '/%1[0-9a-f]/i';
            $nonDisplayables[] = '/%7f/i';
        }

        $nonDisplayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';

        do {
            $str = preg_replace($nonDisplayables, '', $str, -1, $count);
        } while ($count);

        return $str;
    }
}

if (! function_exists('_stringify_attributes')) {
    function _stringify_attributes($attributes, $js = false)
    {
        $atts = null;

        if (empty($attributes)) {
            return $atts;
        }

        if (is_string($attributes)) {
            return ' '.$attributes;
        }

        $attributes = (array) $attributes;

        foreach ($attributes as $key => $val) {
            $atts .= $js ? $key.'='.$val.',' : ' '.$key.'="'.$val.'"';
        }

        return rtrim($atts, ',');
    }
}
