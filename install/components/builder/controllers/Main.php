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

        $installation = new Installation();

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
                $installation->setConfigParam('admintheme', $adminTheme);

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

        $installation = new Installation();
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

        $installation = new Installation();
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
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($paramFields, $this->component);
            Fields::setErrors($paramFields);
        }
    }
}