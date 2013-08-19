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

$installation = new Installation();

$components = $installation->getComponents();
foreach ($components as $component) {

    $componentPath = $component['path'];
    $componentName = $component['name'];

    $install = $installation->install($componentName, $componentPath);
}

$modules = $installation->getModules();
foreach ($modules as $module) {

    $modulePath = $module['path'];
    $moduleName = $module['name'];

    $install = $installation->install($moduleName, $modulePath);
}
