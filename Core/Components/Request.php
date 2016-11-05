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


    /**
     * returns the requested controller
     *
     * @return string
     */
    public function getController()
    {
        return !empty($this->get->controller) ? $this->get->controller : self::DEFAULTCONTROLLER;
    }


    /**
     * returns the requested controller action
     *
     * @return string
     */
    public function getAction()
    {
        return !empty($this->get->action) ? $this->get->action : self::DEFAULTACTION;
    }


    /**
     * returns all parameters
     *
     * @return object
     */
    public function getParams()
    {
        return $this->params;
    }


    /**
     * returns the value of the given parameter or the default value if the parameter does not exist
     *
     * @param string $param
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function getParam(string $param, $default = null)
    {
        return isset($this->params->$param) ? $this->params->$param : $default;
    }


    /**
     * sets a new parameter or updates an existing one
     *
     * @param string $param
     * @param mixed  $value
     */
    public function setParam(string $param, $value = null)
    {
        $this->params->$param = $value;
    }


    /**
     * returns all get parameters
     *
     * @return object
     */
    public function getGetParams()
    {
        return $this->get;
    }


    /**
     * returns the value of the given get parameter or the default value if the parameter does not exist
     *
     * @param string $param
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function getGetParam(string $param, $default = null)
    {
        return isset($this->get->$param) ? $this->get->$param : $default;
    }


    /**
     * sets a new get parameter or updates an existing one
     *
     * @param string $param
     * @param mixed  $value
     */
    public function setGetParam(string $param, $value = null)
    {
        $this->get->$param = $value;
        $this->setParam($param, $value);
    }


    /**
     * returns all post parameters
     *
     * @return object
     */
    public function getPostParams()
    {
        return $this->post;
    }


    /**
     * returns the value of the given post parameter or the default value if the parameter does not exist
     *
     * @param string $param
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function getPostParam(string $param, $default = null)
    {
        return isset($this->post->$param) ? $this->post->$param : $default;
    }


    /**
     * sets a new post parameter or updates an existing one
     *
     * @param string $param
     * @param mixed  $value
     */
    public function setPostParam(string $param, $value = null)
    {
        $this->post->$param = $value;
        $this->setParam($param, $value);
    }


    /**
     * @deprecated use getPostParams or getPostParam
     *
     * @param string|null $key
     *
     * @return object|mixed|null
     */
    public function getPost(string $key = null)
    {
        return $key === null ? $this->getPostParams() : $this->getPostParam($key);
    }


    /**
     * @deprecated use setPostParam
     *
     * @param string $param
     * @param mixed  $value
     */
    public function setPost(string $param, $value = null)
    {
        $this->setPostParam($param, $value);
    }


    /**
     * @deprecated use getGetParams
     * @return object
     */
    public function getGet()
    {
        return $this->getGetParams();
    }


    /**
     * @deprecated use setGetParam
     *
     * @param string $param
     * @param mixed  $value
     */
    public function setGet(string $param, $value = null)
    {
        $this->setGetParam($param, $value);
    }


    /**
     * splits the url to get controller and action
     * required for routing
     */
    protected function splitUrl()
    {
        $url = $this->getParam('url');

        $url = explode('/', $url);
        $this->setGetParam('controller', $url[0]);

        if (isset($url[1])) {
            $this->setGetParam('action', $url[1]);
        }
    }
}