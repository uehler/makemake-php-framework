<?php

namespace Core;

class View
{
    protected $themePath;
    protected $themeDir;
    protected $template;
    protected $data;


    public function __construct($controller, $action, $themePath, $themeDir = '')
    {
        $this->defaultTemplate = $controller . DIRECTORY_SEPARATOR . $action . '.php';
        $this->themePath = $themePath;
        $this->themeDir = $themeDir;
        $this->data = new \stdClass();
    }


    public function assign($name, $value)
    {
        $this->data->$name = $value;
    }


    public function loadTemplate($template)
    {
        $this->template = $template;
    }


    public function render()
    {
        $template = empty($this->template) ? $this->defaultTemplate : $this->template;

        $data = $this->data; // used in template

        include $this->themePath . DIRECTORY_SEPARATOR . $this->themeDir . DIRECTORY_SEPARATOR . $template;
    }
}