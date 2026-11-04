<?php

namespace App\Legacy;

use App\Libraries\Layout;

#[\AllowDynamicProperties]
class CI_Controller
{
    private static ?self $instance = null;

    public $config;
    public $lang;
    public $input;
    public $uri;
    public $output;
    public $session;
    public $security;
    public $db;
    public $load;
    public $router;
    public $layout;

    public function __construct()
    {
        self::$instance = $this;

        foreach (Runtime::$services as $name => $service) {
            $this->{$name} = $service;
        }

        $this->layout = new Layout();
    }

    public static function &get_instance()
    {
        return self::$instance;
    }
}
