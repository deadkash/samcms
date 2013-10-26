<?php

/**
 * Класс для отрисовки шаблонов
 *
 * @project SamCMS
 * @package core
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Templater extends Core {

    /**
     * Массив классов твига
     * @var array
     */
    private static $templaters;

    /** @var bool Использовать языковые метки */
    private static $useLanguage = true;

    /**
     * Установка флага использования языковых меток
     * @param $flag
     */
    public static function setUseLanguage($flag){
        self::$useLanguage = $flag;
    }

    /**
     * Отрисовывает шаблон
     *
     * @param $path корень файловой системы
     * @param $tplPath путь к шаблону
     * @param $data данные
     * @return string
     */
    public static function render($path, $tplPath, $data) {

        if (!file_exists($path.'/'.$tplPath)) {
            ApplicationHelper::setTemplateNotExists($path.'/'.$tplPath);
            return false;
        }

        //Вставка языковых меток
        if (self::$useLanguage) {
            $data['ln'] = Language::getDictionary(Parameters::getParameter('language'));
        }

        //Если класс шаблонизатора существует, то рисуем сразу
        if (isset(self::$templaters[$path]) && self::$templaters) {

            /** @var $twig Twig_Environment */
            $twig = self::$templaters[$path];
        }
        else {

            $loader = new Twig_Loader_Filesystem($path);
            $twig = new Twig_Environment($loader, array( 'cache' => ABS_PATH.'cache/twig', 'debug' => true, 'autoescape' => false));
            self::$templaters[$path] = $twig;
        }

        $template = $twig->loadTemplate($tplPath);
        return $template->render($data);
    }
}