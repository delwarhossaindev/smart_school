<?php

namespace App\Legacy;

class Config
{
    public array $config;

    private array $loaded = [];

    public function __construct(string $baseUrl)
    {
        $this->config = [
            'base_url' => $baseUrl,
            'index_page' => '',
            'url_suffix' => '',
            'charset' => 'UTF-8',
            'language' => 'english',
            'enable_query_strings' => false,
            'csrf_protection' => false,
            'admin_per_page' => 20,
        ];
    }

    public function load($file = '', $useSections = false, $failGracefully = false)
    {
        $file = str_replace('.php', '', $file);

        if (in_array($file, $this->loaded, true)) {
            return true;
        }

        $path = resource_path('legacy/'.$file.'.php');

        if (! is_file($path)) {
            return false;
        }

        $config = [];
        include $path;

        $this->config = array_merge($this->config, $config);
        $this->loaded[] = $file;

        return true;
    }

    public function item($item, $index = '')
    {
        if ($index === '') {
            return $this->config[$item] ?? null;
        }

        return $this->config[$index][$item] ?? null;
    }

    public function slash_item($item)
    {
        if (! isset($this->config[$item])) {
            return null;
        }

        return trim($this->config[$item]) === '' ? '' : rtrim($this->config[$item], '/').'/';
    }

    public function site_url($uri = '', $protocol = null)
    {
        $base = $this->slash_item('base_url');

        if (empty($uri)) {
            return $base;
        }

        $uri = ltrim(is_array($uri) ? implode('/', $uri) : (string) $uri, '/');
        $suffix = $this->config['url_suffix'];

        if (($offset = strpos($uri, '?')) !== false) {
            return $base.substr($uri, 0, $offset).$suffix.substr($uri, $offset);
        }

        return $base.$uri.$suffix;
    }

    public function base_url($uri = '', $protocol = null)
    {
        return $this->slash_item('base_url').ltrim(is_array($uri) ? implode('/', $uri) : (string) $uri, '/');
    }

    public function set_item($item, $value)
    {
        $this->config[$item] = $value;
    }
}
