<?php

$composterAutoloader = __DIR__ . '/vendor/autoload.php';

if (file_exists($composterAutoloader)) {
    require_once($composterAutoloader);
}

spl_autoload_register(function ($className) {
    require_once(__DIR__ . '/' . str_replace('\\', '/', $className) . '.php');
});