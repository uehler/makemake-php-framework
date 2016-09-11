<?php

namespace Core;

use Core\Components\Config;
use Core\Components\Request;

class Controller
{
    protected $request;
    protected $config;
    protected $view;


    public function __construct(Request $request, Config $config)
    {
        $this->request = $request;
        $this->config = $config;

        $dirs = $config->get('directories');

        $this->view = new View($request->getController(), $request->getAction(), $dirs['theme'], $dirs['customThemeDir']);
    }


    public function preDispatch()
    {
    }


    public function postDispatch()
    {
        $this->view->render();
    }
}