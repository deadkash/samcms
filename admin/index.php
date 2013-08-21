<?php

/**
 * Индексный файл административной панели
 *
 * @project SamCMS
 * @package root
 * @author Kash
 * @date 27.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

ini_set("display_errors","1");
ini_set("error_reporting", E_ALL);

define('ADMIN', 1);
require_once __DIR__.'/../loader.php';
Autoloader::setAppPath(ABS_PATH.'admin/');

$application = new Application();

$application->route();
$application->access();
$application->run();

require_once __DIR__.'/../debug.php';