<?php

namespace App\Legacy;

class Uri
{
    public function segment($n, $default = null)
    {
        return request()->segments()[$n - 1] ?? $default;
    }

    public function rsegment($n, $default = null)
    {
        return $this->segment($n, $default);
    }

    public function segment_array()
    {
        $segments = request()->segments();

        return $segments ? array_combine(range(1, count($segments)), $segments) : [];
    }

    public function total_segments()
    {
        return count(request()->segments());
    }

    public function uri_string()
    {
        return trim(request()->path(), '/');
    }

    public function ruri_string()
    {
        return $this->uri_string();
    }
}
