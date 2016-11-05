<?php

namespace Core;

use Core\Components\Config;
use Core\Components\Request;

class Kernel
{
    protected $config;
    /** @var Request */
    protected $request;


    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->request = new Request();
    }


    public function load()
    {
        $ctrlPath = 'App\\Controller\\' . ucfirst($this->request->getController());

        /** @var Controller $controller */
        $controller = new $ctrlPath($this->request, $this->config);
        $controller->preDispatch();
        if (method_exists($controller, $this->request->getAction())) {
            $controller->{$this->request->getAction()}();
        } else {
            $controller->error();
        }
        $controller->postDispatch();
    }
}