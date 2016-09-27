<?php

namespace Core\Components;

class Request
{
    protected $post;
    protected $get;
    protected $params;


    public function __construct()
    {
        $this->post = (object)$_POST;
        $this->get = (object)$_GET;
        $this->params = (object)array_merge($_GET, $_POST);
    }


    public function getController()
    {
        if (empty($this->get->controller)) {
            $this->get->controller = 'index';
        }

        return $this->get->controller;
    }


    public function getAction()
    {
        if (empty($this->get->action)) {
            $this->get->action = 'index';
        }

        return $this->get->action;
    }


    public function getParams()
    {
        return $this->params;
    }


    public function getPost($key = null)
    {
        return $key === null ? $this->post : $this->post->$key;
    }


    public function getGet()
    {
        return $this->get;
    }
}