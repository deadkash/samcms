<?php

/**
 * Загрузчик основных библиотек
 *
 * @project SamCMS
 * @author Kash
 * @package root
 * @date 28.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Autoloader {

    /** @var string Путь приложения */
    private static $appPath = null;

    /**
     * Классы ядра
     * @var array
     */
    private static $coreClasses = array(
        'Application',
        'Access',
        'DB',
        'Debug',
        'Hash',
        'Log',
        'Mailer',
        'Parameters',
        'Request',
        'Router',
        'Templater',
        'Translate',
        'Messages',
        'Seo',
        'Language',
        'Fields',
        'Captcha',
        'Image',
        'header',
        'Cache',
        'Installation'
    );

    /**
     * Классы классов
     * @var array
     */
    private static $classClasses = array(
        'Component',
        'Controller',
        'Core',
        'Editor',
        'Model',
        'Module',
        'Route',
        'View',
        'Document',
        'Plugin',
        'Field',
        'Install'
    );

    /**
     * Установка пути к приложению
     * @param string $path
     */
    public static function setAppPath($path){
        self::$appPath = $path;
    }

    /**
     * Метод вызывается при попытке создания экземпляра класса, которого нет в окружении приложения
     * @param $className string
     */
    public static function load($className) {

        if (empty(self::$appPath)) self::$appPath = APP_PATH;

        $className = preg_replace('/([a-z])([A-Z])/', '$1_$2', $className);
        $pathArray = explode('_', $className);

        $name = false;
        $type = false;
        $path = false;

        if (isset($pathArray[0])) $name = $pathArray[0];
        if (isset($pathArray[1])) $type = $pathArray[1];

        //Если класс ядра
        if (in_array($className, self::$coreClasses)) {
            $type = 'Core';
            $name = $className;
        }

        //Если класс классов
        if (in_array($className, self::$classClasses)) {
            $type = 'Class';
            $name = $className;
        }

        switch ($type) {

            case 'Core':
                $path =  __DIR__.'/core/'.$name.'.php';
                break;

            case 'Class':
                $path = __DIR__.'/core/classes/'.$name.'.php';
                break;

            case 'Helper':
                $path = __DIR__.'/core/helpers/'.$name.'.php';
                break;

            case 'Controller':
                $controller = $pathArray[2];
                $path = self::$appPath.'components/'.strtolower($name).'/controllers/'.$controller.'.php';
                break;

            case 'View':
                $view = $pathArray[2];
                $path = self::$appPath.'components/'.strtolower($name).'/views/'.strtolower($view).'/'.$view.'.php';
                break;

            case 'Model':
                $model = $pathArray[2];
                $path = self::$appPath.'components/'.strtolower($name).'/models/'.$model.'.php';
                break;

            case 'Consts':
                $path = self::$appPath.'components/'.strtolower($name).'/Consts.php';
        }

        if ($path && file_exists($path)) require_once($path);
    }
}

//Определение путей
$rootPath = __DIR__.'/';
if (defined('ADMIN')) $rootPath .= 'admin/';
define('APP_PATH', $rootPath);
define('ABS_PATH', __DIR__.'/');
define('PLUGINS_PATH', APP_PATH.'plugins/');

//E-mail для ответов
define('NOREPLY_EMAIL', 'no-reply@'.str_replace('www.','', $_SERVER['HTTP_HOST']));

$startTime = microtime(1);

require_once('config.php');
require_once('lib/Twig/Autoloader.php');
Twig_Autoloader::register();
spl_autoload_register(array('Autoloader', 'load'));