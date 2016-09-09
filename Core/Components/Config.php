<?php

namespace Core\Components;

class Config
{
    protected $config = array(
        'coreVersion' => '0.0.0',
        'version' => '0.0.0', // version of user code
        'environment' => 'dev', // or live

        'directories' => array(
            'app' => 'App',
            'core' => 'Core',
        ),

        'db' => array(
            'user' => '',
            'password' => '',
            'database' => '',
            'host' => 'localhost',
            'port' => '3306'
        ),
    );


    public function __construct()
    {
        $this->config = array_replace_recursive($this->config, include('config.php'));
    }


    public function get($value = null)
    {
        return $this->config[$value];
    }


    public function getConfig()
    {
        return $this->config;
    }
}