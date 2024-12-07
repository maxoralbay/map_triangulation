<?php

/**
 *  Config File For Handel Route, Database And Request
 *
 *  Author: Maks Oralbay
 *  Email: code.datum@gmail.com
 *  WebPage: afgprogrammer.com
 *
 */

// Http Url
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('HTTP_URL', '/' . substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));

// Define Path Application
define('SCRIPT', str_replace('\\', '/', rtrim(__DIR__, '/')) . '/');
define('SYSTEM', SCRIPT . 'System/');
define('CONTROLLERS', SCRIPT . 'Application/Controllers/');
define('MODELS', SCRIPT . 'Application/Models/');
define('UPLOAD', SCRIPT . 'Upload/');
define('VIEWS', SCRIPT . 'Application/public/');
define('PUBLIC_DIR', __DIR__ . '/public');
define('APPLICATION', SCRIPT . 'Application/');
// Config Database
define('DATABASE', [
    'Port' => '3306',
    'Host' => 'mysql',
    'Driver' => 'PDO',
    'Name' => 'db',
    'User' => 'user',
    'Pass' => 'secret',
    'Prefix' => ''
]);

// DB_PREFIX
define('DB_PREFIX', '');
