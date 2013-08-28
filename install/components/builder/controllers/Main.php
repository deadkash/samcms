<?php

/**
 * Контроллер
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

            case 'setUser':
                $this->setUser();
                break;

            case 'setParams':
                $this->setParams();
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
     * @return void
     */
    private function setConfig(){

        $installation = Installation::create();

        $siteTheme = Request::getStr('theme');
        $adminTheme = Request::getStr('admintheme');

        $dbConfig = new stdClass();
        $dbFields = BuilderConsts::getDBFields();
        foreach ($dbFields as &$field) {
            $fieldName = $field->name;
            $dbConfig->$fieldName = Request::getStr($fieldName);
            $field->value = $dbConfig->$fieldName;
        }

        //Если данные валидны
        if (Fields::validate($dbFields)) {

            if (!$installation->checkDBConnect($dbConfig)) {
                Messages::addMessage('dbconnect_error', 'alert-danger', Language::translate('install_dbconnect_error'));
            }
            else {

                $installation->setConfigParam('dbhost', $dbConfig->dbhost);
                $installation->setConfigParam('dbuser', $dbConfig->dbuser);
                $installation->setConfigParam('dbpass', $dbConfig->dbpass);
                $installation->setConfigParam('dbname', $dbConfig->dbname);
                $installation->setConfigParam('theme', $siteTheme);
                $installation->setConfigParam('adminTheme', $adminTheme);

                $installation->generateConfig();
                $installation->db = DB::create();
                $installation->executeSQL(ABS_PATH.'install/sql/install.sql');

                Router::redirect('/install/?view=user');
            }
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($dbFields, $this->component);
            Fields::setErrors($dbFields);
        }
    }

    /**
     * Установка пользователя
     * @return void
     */
    private function setUser(){

        $installation = Installation::create();
        $access = new Access();

        $user = new stdClass();
        $userFields = BuilderConsts::getUserFields();
        foreach ($userFields as &$field) {
            $fieldName = $field->name;
            $user->$fieldName = Request::getStr($fieldName);
            $field->value = $user->$fieldName;
        }

        if (Fields::validate($userFields)) {

            $addValid = true;

            if (!$access->checkPasswords($user->password, $user->confirm_password)) {
                Messages::addMessage('password_not_match', 'alert-danger',
                    Language::translate('install_password_not_match'));
                $addValid = false;
            }

            if (!$access->checkPassMinLength($user->password)) {
                Messages::addMessage('password_too_short', 'alert-danger',
                    Language::translate('install_password_too_short'));
                $addValid = false;
            }

            if ($addValid) {

                //Создаем группы пользователей
                $adminGroupId = $installation->addUserGroup(Language::translate('install_superuser_group'));
                $regUserGroupId = $installation->addUserGroup(Language::translate('install_reg_group'));
                $unregUserGroupId = $installation->addUserGroup(Language::translate('install_unreg_group'));
                $installation->setConfigParam('defaultPolicy', $unregUserGroupId);
                $installation->setConfigParam('registerPolicy', $regUserGroupId);
                $installation->rebuildConfig();

                //Создаем администратора
                $installation->addUser($user->login, $user->email, $user->password, $adminGroupId);

                Router::redirect('/install/?view=params');
            }
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($userFields, $this->component);
            Fields::setErrors($userFields);
        }
    }

    /**
     * Установка параметров
     * @return void
     */
    private function setParams(){

        $installation = Installation::create();
        $params = new stdClass();
        $paramFields = BuilderConsts::getParamsFields();
        foreach ($paramFields as &$field) {
            $fieldName = $field->name;
            $params->$fieldName = Request::getStr($fieldName);
            $field->value = $params->$fieldName;
        }

        if (Fields::validate($paramFields)) {

            //Обновляем параметры
            $installation->executeSQL(ABS_PATH.'install/sql/parameters.sql');
            $installation->updateParams($params);

            $this->setAdminMenus();
            $this->setAdminModules();
            $this->setAdminValues();
            $this->setFrontValues();
            $this->setElements();

            Router::redirect('/install/?view=done');
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($paramFields, $this->component);
            Fields::setErrors($paramFields);
        }
    }

    /**
     * Создает админские меню
     * @return void
     */
    private function setAdminMenus() {

        $installation = Installation::create();

        //Создаем верхнее и левое меню системы управления
        $topAdminMenuId = $installation->addAdminMenu('admin_top_menu');
        $installation->setTopAdminMenuId($topAdminMenuId);
        $leftAdminMenuId = $installation->addAdminMenu('admin_left_menu');
        $installation->setLeftAdminMenuId($leftAdminMenuId);
    }

    /**
     * Установка админских модулей
     * @return void
     */
    private function setAdminModules() {

        $installation = Installation::create();

        $upMenuModuleId = $installation->addAdminModule('Menu', 'upmenu', 'admin_upmenu_module',
            BuilderConsts::getAdminLeftMenuParams($installation->getTopAdminMenuId(), 'upmenu.html'));
        $leftMenuModuleId = $installation->addAdminModule('Menu', 'leftmenu', 'admin_leftmenu_module',
            BuilderConsts::getAdminLeftMenuParams($installation->getLeftAdminMenuId(), 'leftmenu.html'));
        $userModuleId = $installation->addAdminModule('User', 'user', 'admin_user_module', array());

        $installation->setAdminModule($upMenuModuleId);
        $installation->setAdminModule($leftMenuModuleId);
        $installation->setAdminModule($userModuleId);
    }

    /**
     * Установка админских переменных и разделов
     * @return void
     */
    private function setAdminValues() {

        $installation = Installation::create();

        //Создаем стартовый раздел системы управления
        $adminMainContent = $installation->getAdminMainContent();
        $adminMainSectionId = $installation->addAdminMainSection('core_admin_main_title',
            $installation->getTopAdminMenuId(), $adminMainContent);
        $installation->updateParam('default_admin_section', $adminMainSectionId);
        $installation->setDenySection(Config::$defaultPolicy, $adminMainSectionId);
        $installation->initAdminModulesOnSection($adminMainSectionId);

        //Создать страницу 404 ошибки системы управления
        $admin404Content = $installation->getAdmin404Content();
        $admin404sectionId = $installation->addAdmin404Section('core_admin_404_title',
            $installation->getTopAdminMenuId(), $admin404Content);
        $installation->updateParam('404_section_admin', $admin404sectionId);

        //Создаем страницу 403 ошибки системы управления
        $admin403Content = $installation->getAdmin403Content();
        $admin403sectionId = $installation->addAdmin403Section('core_admin_403_title',
            $installation->getTopAdminMenuId(), $admin403Content);
        $installation->updateParam('403_section', $admin403sectionId);

        //Создаем страницу авторизации
        $authSectionId = $installation->addAuthSection('core_auth_title', $installation->getTopAdminMenuId());
        $installation->updateParam('auth_section', $authSectionId);

        //Создаем страницу восстановления пароля
        $recoverSectionId = $installation->addRecoverSection('core_recover_title', $installation->getTopAdminMenuId());
        $installation->updateParam('recover_section', $recoverSectionId);

        //Выбираем язык
        $language = (isset($_SESSION['install_language'])) ? $_SESSION['install_language'] : '';
        $installation->updateParam('language', $language);
    }

    /**
     * Устанавливает параметры и разделы клиентской части
     * @return void
     */
    private function setFrontValues() {

        $installation = Installation::create();

        //Создаем основное меню
        $userMainMenuId = $installation->addUserMenu(Language::translate('install_main_user_menu'));

        //Добавляем главную
        $userMainSectionContent = Language::translate('install_main_title');
        $userMainSectionId = $installation->addUserMainSection(Language::translate('install_main_title'), $userMainMenuId,
            $userMainSectionContent);
        $installation->updateParam('default_section', $userMainSectionId);

        //Добавляем 404 страницу

        //Сохраняем в параметрах
    }

    /**
     * Обходит элементы и устанавливает их
     * @return void
     */
    private function setElements(){

        $installation = Installation::create();

        $components = $installation->getComponents();
        foreach ($components as $component) {
            $installation->install($component['name'], $component['path']);
        }

        $modules = $installation->getModules();
        foreach ($modules as $module) {
            $installation->install($module['name'], $module['path']);
        }
    }
}