<?php

namespace App\Legacy;

#[\AllowDynamicProperties]
class CI_Model
{
    public function __construct()
    {
    }

    public function __get($key)
    {
        return get_instance()->{$key};
    }
}
