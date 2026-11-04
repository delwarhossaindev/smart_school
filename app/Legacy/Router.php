<?php

namespace App\Legacy;

class Router
{
    public function __construct(public ?string $module, public string $class, public string $method)
    {
    }

    public function fetch_module()
    {
        return $this->module;
    }

    public function fetch_class()
    {
        return $this->class;
    }

    public function fetch_method()
    {
        return $this->method;
    }
}
