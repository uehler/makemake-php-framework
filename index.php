<?php

require_once('autoloader.php');

$config = new \Core\Components\Config();

if ($config->get('environment') == 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

$kernel = new \Core\Kernel($config);
$kernel->load();