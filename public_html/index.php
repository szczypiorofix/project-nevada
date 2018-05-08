<?php
/*
 * 
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
define('START_TIME', $start);

/*
 * Load AutoLoader class.
 */
require_once '../App/Core/Autoloader.php';
/*
 * Run the AutoLoader class.
 */
\Core\AutoLoader::run();

/*
 * Run the AutoLoader for vendors.
 */
require_once("../App/vendor/autoload.php");

/*
 * Set required environmental variables and constants.
 */
\Core\Environment::set();

/*
 * Start core application.
 */
\Core\AppCore::start();
