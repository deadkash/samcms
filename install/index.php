<?php
/**
 * Индексный файл установщика нового приложения
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 17.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

ini_set("display_errors","1");
ini_set("error_reporting", E_ALL);

session_start();
require_once(__DIR__.'/../loader.php');
require_once(ABS_PATH.'install/components/builder/Builder.php');
require_once(ABS_PATH.'install/modules/message/Message.php');

Autoloader::setAppPath(ABS_PATH.'install/');
Templater::setUseLanguage(false);
Language::setCustomDictionary(ABS_PATH.'install/languages/russian/');

$builder = new Builder();
echo $builder->render();