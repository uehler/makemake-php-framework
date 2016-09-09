<?php

namespace Core;

use Core\Components\Config;
use Core\Components\Request;

class Kernel
{
    protected $config;


    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    public function load()
    {
        $directories = $this->config->get('directories');
        $appComponents = scandir($directories['app']);

        foreach ($appComponents as $appComponent) {
            if (!ctype_alpha($appComponent)) {
                continue;
            }

            $componentPath = $directories['app'] . '/' . $appComponent;
            $components = scandir($componentPath);

            $coreComponent = $appComponent . '.php';

            if (file_exists('Core/' . $coreComponent)) {
                require 'Core/' . $coreComponent; // load core equivalent
            }
            foreach ($components as $component) {
                if (stripos($component, '.php') !== false) {
                    $str = $componentPath . '/' . $component;
                    if (file_exists($str)) {
                        require $str;
                    }
                }
            }
        }

        require_once 'Core/Components/Request.php';
        $request = new Request();

        $ctrlPath = 'App\\Controller\\' . ucfirst($request->getController());
        $controller = new $ctrlPath($request, $this->config);

        $controller->{$request->getAction()}();
    }
}