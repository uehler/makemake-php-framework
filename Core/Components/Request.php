<?php

namespace Core\Components;

class Request
{
    const DEFAULTCONTROLLER = 'index';
    const DEFAULTACTION = 'index';
    protected $post;
    protected $get;
    protected $params;


    public function __construct()
    {
        $this->post = (object) $_POST;
        $this->get = (object) $_GET;
        $this->params = (object) array_merge($_GET, $_POST);

        $this->splitUrl();
    }


    public function getController()
    {
        if (empty($this->get->controller)) {
            $this->setGet('controller', self::DEFAULTCONTROLLER);
        }

        return $this->get->controller;
    }


    public function getAction()
    {
        if (empty($this->get->action)) {
            $this->setGet('action', self::DEFAULTACTION);
        }

        return $this->get->action;
    }


    public function getParams()
    {
        return $this->params;
    }


    public function getParam(string $param, $default = null)
    {
        return isset($this->params->$param) ? $this->params->$param : $default;
    }


    public function setParam(string $param, $value = null)
    {
        $this->params->$param = $value;
    }


    public function getPost(string $key = null)
    {
        return $key === null ? $this->post : $this->post->$key;
    }


    public function setPost(string $param, $value = null)
    {
        $this->post->$param = $value;
        $this->params->$param = $value;
    }


    public function getGet()
    {
        return $this->get;
    }


    public function setGet(string $param, $value = null)
    {
        $this->get->$param = $value;
        $this->params->$param = $value;
    }


    /**
     * splits the url to get controller and action
     */
    protected function splitUrl()
    {
        $url = $this->getParam('url');

        $url = explode('/', $url);
        $this->setGet('controller', $url[0]);

        if (isset($url[1])) {
            $this->setGet('action', $url[1]);
        }
    }
}