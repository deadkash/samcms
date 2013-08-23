<?php

/**
 * Контроллер приветствия
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 21.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class BuilderControllerMain extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Welcome';

    /**
     * Конструктор
     */
    public function __construct() {}

    /**
     * Запуск контроллера
     * @return mixed|void
     */
    public function execute() {

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'setLanguage':
                $this->setLanguage();
                break;

            case 'setConfig':
                $this->setConfig();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        return $view->display();
    }

    /**
     * Установка языка установки
     * @return bool
     */
    private function setLanguage() {

        $language = Request::getStr('language');
        if (!$language) return false;

        $_SESSION['install_language'] = $language;
        $languagePath = ABS_PATH.'install/languages/'.$language.'/';
        if (!file_exists($languagePath)) return false;

        Language::setCustomDictionary($languagePath);

        return true;
    }

    /**
     * Установка конфигурации
     * @return bool
     */
    private function setConfig(){

        $installation = new Installation();

        $dbhost = Request::getStr('dbhost');
        $dbuser = Request::getStr('dbuser');
        $dbpass = Request::getStr('dbpass');
        $dbname = Request::getStr('dbname');
        $siteTheme = Request::getStr('theme');
        $adminTheme = Request::getStr('admintheme');

        //Валидация

        $installation->setConfigParam('dbhost', $dbhost);
        $installation->setConfigParam('dbuser', $dbuser);
        $installation->setConfigParam('dbpass', $dbpass);
        $installation->setConfigParam('dbname', $dbname);
        $installation->setConfigParam('theme', $siteTheme);
        $installation->setConfigParam('admintheme', $adminTheme);

        $installation->generateConfig();
    }
}