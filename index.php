<?php

/**
 * @project SamCMS
 * @author Kash
 * @package root
 * @date 28.07.12
 * @source index.php
 * @version 0.2.3
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

ini_set("display_errors","1");
ini_set("error_reporting", E_ALL);

require_once('loader.php');

$application = new Application();

$application->route();
$application->access();
$application->run();

require_once('debug.php');