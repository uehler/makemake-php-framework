<?php

namespace Core;

use Core\Components\Config;
use Core\Components\Request;

class Controller
{
    protected $request;
    protected $config;


    public function __construct(Request $request, Config $config)
    {
        $this->request = $request;
        $this->config = $config;

        $view = new View();
    }
}