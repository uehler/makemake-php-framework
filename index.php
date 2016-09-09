<?php

require 'Core/Components/Config.php';

$config = new \Core\Components\Config();

if ($config->get('environment') == 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

require 'Core/Kernel.php';

$kernel = new \Core\Kernel($config);
$kernel->load();