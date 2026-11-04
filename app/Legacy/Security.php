<?php

namespace App\Legacy;

class Security
{
    public function xss_clean($value, $isImage = false)
    {
        if (is_array($value)) {
            return array_map([$this, 'xss_clean'], $value);
        }

        return is_string($value) ? strip_tags($value) : $value;
    }

    public function strip_image_tags($value)
    {
        return preg_replace('#<img\s[^>]*src\s*=\s*["\']?([^"\'\s>]+)["\']?[^>]*>#i', '$1', $value);
    }
}
