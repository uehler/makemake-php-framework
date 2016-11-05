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
        $request = new Request();

        $ctrlPath = 'App\\Controller\\' . ucfirst($request->getController());

        /** @var Controller $controller */
        $controller = new $ctrlPath($request, $this->config);

        $controller->preDispatch();
        $controller->{$request->getAction()}();
        $controller->postDispatch();
    }
}