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


    public function getModel($model)
    {
        $str = '\App\Model\\' . ucfirst($model);

        return new $str();
    }


    /**
     * the error page
     */
    public function error()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->loadTemplate('_default/error.php');
    }
}