<?php

namespace App\Legacy;

class Lang
{
    public array $language = [];

    private array $loaded = [];

    public function load($file, $idiom = '', $return = false)
    {
        if (is_array($file)) {
            foreach ($file as $item) {
                $this->load($item, $idiom);
            }

            return $this->language;
        }

        $file = preg_replace('/(_lang)?(\.php)?$/', '', $file);
        $idiom = $idiom ?: 'english';
        $key = $idiom.'/'.$file;

        if (! $return && isset($this->loaded[$key])) {
            return $this->language;
        }

        $path = base_path('lang/'.$idiom.'/'.$file.'_lang.php');

        if (! is_file($path)) {
            show_error('Unable to load the requested language file: language/'.$idiom.'/'.$file.'_lang.php');
        }

        $lang = [];
        include $path;

        if ($return) {
            return $lang;
        }

        $this->loaded[$key] = true;
        $this->language = array_merge($this->language, $lang);

        return $this->language;
    }

    public function line($line, $logErrors = true)
    {
        return $this->language[$line] ?? false;
    }
}
