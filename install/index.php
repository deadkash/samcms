<?php
/**
 *
 *
 * @project SamCMS
 * @package 
 * @author Kash
 * @version 0.2.1
 * @date 17.08.13
 */

ini_set("display_errors","1");
ini_set("error_reporting", E_ALL);

require_once(__DIR__.'/../loader.php');
require_once(ABS_PATH.'install/components/builder/Builder.php');

Autoloader::setAppPath(ABS_PATH.'install/');
Templater::setUseLanguage(false);

$builder = new Builder();
echo $builder->render();