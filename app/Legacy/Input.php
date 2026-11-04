<?php

namespace App\Legacy;

class Input
{
    public function post($index = null, $xssClean = false)
    {
        return $this->fetch($_POST, $index, $xssClean);
    }

    public function get($index = null, $xssClean = false)
    {
        return $this->fetch($_GET, $index, $xssClean);
    }

    public function post_get($index, $xssClean = false)
    {
        return isset($_POST[$index]) ? $this->post($index, $xssClean) : $this->get($index, $xssClean);
    }

    public function get_post($index, $xssClean = false)
    {
        return isset($_GET[$index]) ? $this->get($index, $xssClean) : $this->post($index, $xssClean);
    }

    public function cookie($index = null, $xssClean = false)
    {
        return $this->fetch($_COOKIE, $index, $xssClean);
    }

    public function server($index, $xssClean = false)
    {
        return $this->fetch($_SERVER, $index, $xssClean);
    }

    public function ip_address()
    {
        return request()->ip();
    }

    public function user_agent($xssClean = false)
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? null;
    }

    public function method($upper = false)
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        return $upper ? strtoupper($method) : strtolower($method);
    }

    public function is_ajax_request()
    {
        return strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'xmlhttprequest';
    }

    public function valid_ip($ip, $which = '')
    {
        return filter_var($ip, FILTER_VALIDATE_IP) !== false;
    }

    private function fetch(array $source, $index, $xssClean)
    {
        if ($index === null) {
            $values = $source;
        } elseif (is_array($index)) {
            $values = [];
            foreach ($index as $key) {
                $values[$key] = $source[$key] ?? null;
            }
        } else {
            $values = $source[$index] ?? $this->fetchNested($source, $index);
        }

        return $xssClean ? get_instance()->security->xss_clean($values) : $values;
    }

    /**
     * Supports names like "items[0][name]", as CI_Input does.
     */
    private function fetchNested(array $source, string $index)
    {
        if (! preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches) || count($matches[0]) < 2) {
            return null;
        }

        $value = $source;

        foreach ($matches[0] as $key) {
            $key = trim($key, '[]');

            if ($key === '') {
                break;
            }
            if (! is_array($value) || ! array_key_exists($key, $value)) {
                return null;
            }
            $value = $value[$key];
        }

        return $value;
    }
}
