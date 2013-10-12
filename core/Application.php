<?php

/**
 * Основной контроллер приложения
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Application {

    /**
     * Текущий шаблон
     * @var string
     */
    private $template = 'index.twig';

    /**
     * Текущий пункт меню
     * @var int
     */
    private $itemId = null;

    /**
     * Роутинг приложения
     * @var Router
     */
    private $router;

    /**
     * Текущий язык
     * @var string
     */
    public static $language = 'russian';

    /**
     * Конструктор
     */
    public function __construct() {

        session_start();
        Parameters::getParameters();
        $this->router = Router::create();

        $this->theme = (defined('ADMIN')) ? Config::$adminTheme : Config::$theme;
    }

    /**
     * Возвращает объект модуля
     * @param $moduleName mixed Имя модуля
     * @return mixed
     */
    private function getModule($moduleName) {

        $modulePath = ApplicationHelper::getModulePath($moduleName);

        if (!file_exists($modulePath)) {
            ApplicationHelper::setExtensionNotExists($modulePath);
            return false;
        }
        require_once($modulePath);

        $module = new $moduleName;
        $module->itemId = $this->itemId;

        return $module;
    }

    /**
     * Возвращает объект компонента
     * @param $componentName string Имя компонента
     * @return mixed
     */
    private function getComponent($componentName) {

        $componentPath = ApplicationHelper::getComponentPath($componentName);
        if (!file_exists($componentPath)) {
            ApplicationHelper::setExtensionNotExists($componentPath);
            return false;
        }
        require_once($componentPath);

        $component = new $componentName();
        $component->itemId = $this->itemId;

        return $component;
    }

    /**
     * Возвращает модуль, привязанный к пункту меню
     * @return mixed
     */
    private function getCurrentComponent() {

        $itemId = $this->itemId;
        if (!$itemId) $itemId = Request::getInt('id');
        if (!$itemId) $itemId = Parameters::$parameters['default_section'];

        //Компонент раздела
        $itemComponent = ApplicationHelper::getItemComponent($itemId);
        if (!$itemComponent) return false;

        $component = $this->getComponent($itemComponent);
        if (!$component) return false;

        $component->label = 'content';

        return $component;
    }

    /**
     * Выводит html код
     * @return void
     */
    public function run() {

        $document = Document::get();
        $document->setTplPath(APP_PATH.'templates/'.$this->theme);
        $document->setTemplate($this->getTemplate());

        //Получаем компонент раздела
        $component = $this->getCurrentComponent();
        if ($component) {
            $document->setValue('component', $component->render());
        }

        //Контейнер сообщений
        $document->setValue('messages', $this->getModule('Message')->render());

        //Раставляем модули в соответствующие метки
        $this->registerLabels($this->itemId);

        $document->render();
    }

    /**
     * Возвращает шаблон
     * @return bool|string
     */
    private function getTemplate() {
        $template = Parameters::getSectionParameter($this->itemId, 'template');
        if ($template) return $template;
        else return $this->template;
    }

    /**
     * Определяет текущий пункт меню
     * @return void
     */
    public function route() {

        $this->itemId = $this->router->recoverUrl();

        //Если раздел не определился, то открываем страницу с ошибкой
        if (!$this->itemId) {
            $this->itemId = Parameters::getParameter('404_section');
            if (defined('ADMIN')) $this->itemId = Parameters::getParameter('404_section_admin');
        }
    }

    /**
     * Определяет доступ к текущему пункту меню
     * @return void
     */
    public function access() {

        $auth = new Access();
        $access = $auth->getAccess($this->itemId);

        //Если доступа нет
        if (!$access) {

            $user = $auth->getCurrentUser();

            //Если не авторизован, то кидаем на форму авторизации
            if (!$user) {
                $this->itemId = Parameters::$parameters['auth_section'];
                $authUrl = $this->router->getUrl(array('id' => $this->itemId));
                $this->router->redirect($authUrl);
            }
            //Если авторизован, но доступа нет, то кидаем на форбидден
            else {
                $this->itemId = Parameters::$parameters['403_section'];
                $forbiddenUrl = $this->router->getUrl(array('id' => $this->itemId));
                $this->router->redirect($forbiddenUrl);
            }
        }
    }

    /**
     * Регистрирует метки, привязанные к текущему пункту меню
     * @param $itemId int Пункт меню
     */
    private function registerLabels($itemId) {

        $document = Document::get();
        $modules = ApplicationHelper::getSectionModules($itemId);

        foreach ($modules as $module) {
            $moduleClass = $this->getModule($module->name);
            $moduleClass->label = $module->label;
            $document->setValue($module->label, $moduleClass->render());
        }
    }
}