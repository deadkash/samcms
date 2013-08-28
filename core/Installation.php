<?php
/**
 * Класс установки приложения
 *
 * @project SamCMS
 * @package Installation
 * @author Kash
 * @since 0.2.4
 * @date 17.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Installation {

    /** @var string Разделитель sql запросов */
    private $sqlDelimiter = ';';

    /** @var array Параметры для файла конфигурации */
    private $configParams = array();

    /** @var int ID верхнего меню в админке */
    private $topAdminMenuId;

    /** @var int ID левого меню в админке */
    private $leftAdminMenuId;

    /** @var int Порядок компонентов в левом меню */
    private $leftComponentOrdering = 0;

    /** @var array Массив id админских модулей */
    private $adminModules;

    /** @var Installation Экземпляр класса */
    private static $installation;

    /**
     * Создание экземпляра класса
     * @return Installation
     */
    public static function create() {

        if (!self::$installation instanceof self) {
            self::$installation = new self();
        }
        return self::$installation;
    }

    /**
     * Конструктор
     */
    private function __construct() {
        if ($this->issetConfig()) {
            $this->db = DB::create();
        }
    }

    /**
     * Запрет клонирования
     */
    private function __clone(){}

    /**
     * Установка id левого меню в админке
     * @param int $leftAdminMenuId ID меню
     */
    public function setLeftAdminMenuId($leftAdminMenuId) {
        $this->leftAdminMenuId = $leftAdminMenuId;
    }

    /**
     * Возвращает id левого меню в админке
     * @return int
     */
    public function getLeftAdminMenuId() {
        return $this->leftAdminMenuId;
    }

    /**
     * Установка id верхнего меню в админке
     * @param int $topAdminMenuId ID меню
     */
    public function setTopAdminMenuId($topAdminMenuId) {
        $this->topAdminMenuId = $topAdminMenuId;
    }

    /**
     * Возвращает id верхнего меню в админке
     * @return int
     */
    public function getTopAdminMenuId() {
        return $this->topAdminMenuId;
    }

    /**
     * Устанавливает админский модуль
     * @param $moduleId int ID модуля
     */
    public function setAdminModule($moduleId){
        $this->adminModules[] = $moduleId;
    }

    /**
     * Добавляет параметр в конфиг
     * @param string $paramName Имя параметра
     * @param mixed $paramValue Значение параметра
     * @return void
     */
    public function setConfigParam($paramName, $paramValue) {
        $this->configParams[] = array(
            'name' => $paramName,
            'value' => $paramValue
        );
    }

    /**
     * Возвращает компоненты
     * @return array
     */
    public function getComponents(){
        return array_merge($this->getFrontComponents(), $this->getAdminComponents());
    }

    /**
     * Возвращает модули
     * @return array
     */
    public function getModules(){
        return array_merge($this->getFrontModules(), $this->getAdminModules());
    }

    /**
     * Возвращает массив компонентов клиентской части
     * @return array
     */
    private function getFrontComponents(){
        return $this->getComponentsAndModules(ABS_PATH.'components/');
    }

    /**
     * Возвращает массив компонентов админской части
     * @return array
     */
    private function getAdminComponents(){
        return $this->getComponentsAndModules(ABS_PATH.'admin/components/');
    }

    /**
     * Возвращает массив модулей клиентской части
     * @return array
     */
    private function getFrontModules(){
        return $this->getComponentsAndModules(ABS_PATH.'modules/');
    }

    /**
     * Возвращает массив модулей админской части
     * @return array
     */
    private function getAdminModules(){
        return $this->getComponentsAndModules(ABS_PATH.'admin/modules/');
    }

    /**
     * Возвращает массив компонентов или модулей из указанной папки
     * @param $elementPath string Путь к компонентам
     * @return array
     */
    private function getComponentsAndModules($elementPath) {

        $items = scandir($elementPath);
        $elements = array();
        foreach ($items as $item) {

            if ($this->isComponentDir($item, $elementPath)) {
                $componentPath = $elementPath.$item.'/';
                $componentName = ucfirst($item);

                $elements[] = array(
                    'path' => $componentPath,
                    'name' => $componentName
                );
            }
        }

        return $elements;
    }

    /**
     * Является ли указанной директория папкой с компонентом
     * @param $dir Папка
     * @param $path Путь
     * @return bool
     */
    private function isComponentDir($dir, $path) {
        return (is_dir($path.DIRECTORY_SEPARATOR.$dir) && $dir[0] != '.' );
    }

    /**
     * Выполняет sql запросы из файла
     * @param $sqlPath string Путь к sql файлу
     * @return bool
     */
    public function executeSQL($sqlPath) {

        $output = true;
        if (!file_exists($sqlPath)) return false;

        $sqlString = @file_get_contents($sqlPath);
        if (empty($sqlString)) return false;

        $queries = explode($this->sqlDelimiter, $sqlString);
        foreach ($queries as $query) {
            $result = $this->db->query($query);
            if (!$result) $output = $result;
        }

        return $output;
    }

    /**
     * Установка компонента или модуля
     * @param $elementName string Имя компонента или модуля
     * @param $elementPath string Путь к компоненту или модулю
     * @return bool
     */
    public function install($elementName, $elementPath) {

        $installClass = $this->getElementInstallObject($elementName, $elementPath);
        if (!$installClass) return false;

        if ($installClass->registerMe) $this->register($installClass);
        return $installClass->execute();
    }

    /**
     * Возвращает объект установщика компонента или модуля
     * @param $elementName string Имя компонента или модуля
     * @param $elementPath string Путь к компоненту
     * @return mixed
     */
    private function getElementInstallObject($elementName, $elementPath) {

        $installPath = $elementPath.'Install.php';
        if (!file_exists($installPath)) return false;

        require_once($installPath);

        $installClass = $elementName.'Install';
        if (!class_exists($installClass)) return false;

        return new $installClass();
    }

    /**
     * Регистрирует указанное расширение
     * @param Install $install Класс установщика элемента
     * @return bool
     */
    public function register(Install $install){

        $extension = new stdClass();
        $extension->name = $install->getName();
        $extension->title = $install->getTitle();
        $extension->type = $install->getType();
        $extension->params = json_encode($install->getParams());

        return $this->db->insert('extensions', $extension);
    }

    /**
     * Генерирует новый файл конфигурации
     * @return int
     */
    public function generateConfig() {
        return $this->buildConfig($this->configParams);
    }

    /**
     * Генерирует файл конфигурации по параметрам
     * @param $params array Массив параметров
     * @return int
     */
    private function buildConfig($params){

        $data['params'] = $params;
        $tplPath = ABS_PATH.'install/templates/';
        $tplName = 'config.twig';
        $configPath = ABS_PATH.'config.php';

        $configContent = Templater::render($tplPath, $tplName, $data);
        $result = @file_put_contents($configPath, $configContent);

        if ($result) {
            require_once ABS_PATH.'config.php';
        }

        return $result;
    }

    /**
     * Перестраивает файл конфигурации
     * @return bool|int
     */
    public function rebuildConfig(){

        if (!$this->issetConfig()) return false;

        $config = get_class_vars('Config');
        $params = $this->configParams;
        foreach ($config as $name => $value) {

            $params[] = array(
                'name' => $name,
                'value' => $value
            );
        }

        return $this->buildConfig($params);
    }

    /**
     * Добавление группы пользователей
     * @param string $title Название группы
     * @return bool
     */
    public function addUserGroup($title) {

        $group = new stdClass();
        $group->name = $title;

        return $this->db->insert('users_policy', $group);
    }

    /**
     * Создает нового пользователя.
     * @param $login string Логин пользователя
     * @param $email string E-mail пользователя
     * @param $password string Пароль пользователя
     * @param $groupId int ID группы пользователя
     * @return bool
     */
    public function addUser($login, $email, $password, $groupId){

        $access = new Access();
        $user = new stdClass();
        $user->login = $login;
        $user->email = $email;
        $user->active = 1;
        $user->password = $access->preparePassword($password, $login);
        $user->policy_id = $groupId;
        $user->date = date('Y-m-d H:i:s');

        return $this->db->insert('users', $user);
    }

    /**
     * Создает меню системы управления
     * @param $title Название меню
     * @return bool
     */
    public function addAdminMenu($title){

        $menu = new stdClass();
        $menu->title = $title;
        $menu->hide = 1;

        return $this->db->insert('menu', $menu);
    }

    /**
     * Создает пользовательское меню
     * @param $title Название меню
     * @return bool
     */
    public function addUserMenu($title){

        $menu = new stdClass();
        $menu->title = $title;
        $menu->hide = 0;

        return $this->db->insert('menu', $menu);
    }

    /**
     * Добавляет раздел системы управления
     * @param $title string Название раздела
     * @param $menuId int ID меню
     * @param $componentName string Имя компонента
     * @param $sectionAlias string Псевдоним раздела
     * @return bool
     */
    public function addAdminSection($title, $menuId, $componentName, $sectionAlias) {

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = $componentName;
        $item->alias = $sectionAlias;
        $item->active = 0;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 0;
        $item->hide = 1;
        $itemId = $this->db->insert('menu_items', $item);

        return $itemId;
    }

    /**
     * Добавляет главный раздел системы управления
     * @param $title string Название раздела
     * @param $menuId int ID меню
     * @param $content string Содержание раздела
     * @return bool
     */
    public function addAdminMainSection($title, $menuId, $content){

        $componentName = 'Content';
        $sectionAlias = '';
        $itemId = $this->addAdminSection($title, $menuId, $componentName, $sectionAlias);

        $componentName = 'Content';
        $paramName = 'text';
        $paramType = 'editor';
        $paramTitle = 'content_code';
        $this->addComponentParam($content, $componentName, $itemId, $paramName, $paramType, $paramTitle);

        $paramName = 'title';
        $paramType = 'text';
        $paramTitle = 'menueditor_pagetitle';
        $this->addSectionParam($itemId, $paramName, $paramType, $paramTitle, $title);

        return $itemId;
    }

    /**
     * Создает главную страницу
     * @param $title string Заголовок
     * @param $menuId int ID меню
     * @param $content string Содержание раздела
     * @return bool
     */
    public function addUserMainSection($title, $menuId, $content){

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Content';
        $item->alias = '';
        $item->active = 1;
        $item->visible = 1;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 1;
        $item->hide = 0;
        $itemId = $this->db->insert('menu_items', $item);

        $this->addComponentParam($content, 'Content', $itemId, 'text', 'editor', 'content_code');
        $this->addSectionParam($itemId, 'title', 'text', 'menueditor_pagetitle', Parameters::getParameter('meta_title'));
        $this->addSectionParam($itemId, 'description', 'textarea', 'menueditor_pagedescription',
            Parameters::getParameter('meta_description'));
        $this->addSectionParam($itemId, 'keywords', 'textarea', 'menueditor_pagekeywords',
            Parameters::getParameter('meta_keywords'));
        $this->addSectionParam($itemId, 'seo_frequency', 'frequency', 'core_frequency', 'always');
        $this->addSectionParam($itemId, 'seo_priority', 'priority', 'core_priority', '1.0');
        $this->addSectionParam($itemId, 'template', 'text', 'menueditor_pagetemplate', 'index.twig');
        $this->addSectionParam($itemId, 'titleh1', 'text', 'menueditor_titleh1', '');

        return $itemId;
    }

    /**
     * Добавляет 404 страницу
     * @param $title string Заголовок раздела
     * @param $menuId int ID меню
     * @param $content string Содержание раздела
     * @return bool
     */
    public function addUser404Section($title, $menuId, $content){

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Content';
        $item->alias = '404';
        $item->active = 1;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 1;
        $item->hide = 0;
        $itemId = $this->db->insert('menu_items', $item);

        $this->addComponentParam($content, 'Content', $itemId, 'text', 'editor', 'content_code');
        $this->addSectionParam($itemId, 'title', 'text', 'menueditor_pagetitle', $title);
        $this->addSectionParam($itemId, 'description', 'textarea', 'menueditor_pagedescription',
            Parameters::getParameter('meta_description'));
        $this->addSectionParam($itemId, 'keywords', 'textarea', 'menueditor_pagekeywords',
            Parameters::getParameter('meta_keywords'));
        $this->addSectionParam($itemId, 'seo_frequency', 'frequency', 'core_frequency', 'newer');
        $this->addSectionParam($itemId, 'seo_priority', 'priority', 'core_priority', '1.0');
        $this->addSectionParam($itemId, 'template', 'text', 'menueditor_pagetemplate', 'index.twig');
        $this->addSectionParam($itemId, 'titleh1', 'text', 'menueditor_titleh1', '');

        return $itemId;
    }

    /**
     * Добавляет 404 страницу в админку
     * @param $title string Заголовок раздела
     * @param $menuId int ID меню
     * @param $content string Содержание раздела
     * @return bool
     */
    public function addAdmin404Section($title, $menuId, $content){

        $componentName = 'Content';
        $sectionAlias = '404';
        $itemId = $this->addAdminSection($title, $menuId, $componentName, $sectionAlias);

        //Добавление текста в компонент Content
        $paramName = 'text';
        $paramType = 'text';
        $paramTitle = 'content_code';
        $this->addComponentParam($content, $componentName, $itemId, $paramName, $paramType, $paramTitle);

        //Подмена шаблона вывода
        $paramName = 'template';
        $paramTitle = 'menueditor_pagetemplate';
        $paramValue = '404.twig';
        $this->addSectionParam($itemId, $paramName, $paramType, $paramTitle, $paramValue);

        return $itemId;
    }

    /**
     * Добавляет 403 страницу в админку
     * @param $title string Заголовок раздела
     * @param $menuId int ID меню
     * @param $content string Содержание раздела
     * @return bool
     */
    public function addAdmin403Section($title, $menuId, $content){

        $componentName = 'Content';
        $sectionAlias = '403';
        $itemId = $this->addAdminSection($title, $menuId, $componentName, $sectionAlias);

        //Добавление текста в компонент Content
        $paramName = 'text';
        $paramType = 'editor';
        $paramTitle = 'content_code';
        $this->addComponentParam($content, $componentName, $itemId, $paramName, $paramType, $paramTitle);

        //Подмена шаблона вывода
        $paramName = 'template';
        $paramType = 'text';
        $paramTitle = 'menueditor_pagetemplate';
        $paramValue = '403.twig';
        $this->addSectionParam($itemId, $paramName, $paramType, $paramTitle, $paramValue);

        return $itemId;
    }

    /**
     * Добавляет страницу авторизации
     * @param $title string Заголовок раздела
     * @param $menuId int ID меню
     * @return bool
     */
    public function addAuthSection($title, $menuId){

        $componentName = 'Auth';
        $componentSectionAlias = 'auth';
        $itemId = $this->addAdminSection($title, $menuId, $componentName, $componentSectionAlias);

        $paramName = 'view';
        $paramType = 'text';
        $paramTitle = 'auth_view';
        $paramValue = 'Login';
        $this->addComponentParam($paramValue, $componentName, $itemId, $paramName, $paramType, $paramTitle);

        //Подмена шаблона вывода
        $paramName = 'template';
        $paramType = 'text';
        $paramTitle = 'menueditor_pagetemplate';
        $paramValue = 'auth.twig';
        $this->addSectionParam($itemId, $paramName, $paramType, $paramTitle, $paramValue);
        $this->addSectionTitle($itemId, 'auth');

        return $itemId;
    }

    /**
     * Создает страницу восстановления пароля
     * @param $title string Заголовок раздела
     * @param $menuId int ID меню
     * @return bool
     */
    public function addRecoverSection($title, $menuId){

        $componentName = 'Auth';
        $componentSectionAlias = 'recover';
        $itemId = $this->addAdminSection($title, $menuId, $componentName, $componentSectionAlias);

        $paramName = 'view';
        $paramType = 'text';
        $paramTitle = 'auth_view';
        $paramValue = 'Recover';
        $this->addComponentParam($paramValue, $componentName, $itemId, $paramName, $paramType, $paramTitle);

        //Подмена шаблона вывода
        $paramName = 'template';
        $paramType = 'text';
        $paramTitle = 'menueditor_pagetemplate';
        $paramValue = 'auth.twig';
        $this->addSectionParam($itemId, $paramName, $paramType, $paramTitle, $paramValue);
        $this->addSectionTitle($itemId, 'auth_recover');

        return $itemId;
    }

    /**
     * Возвращает текст для главной страницы админки
     * @return string
     */
    public function getAdminMainContent(){

        $tplName = 'admin_content.twig';
        return $this->getAdminSectionContent($tplName);
    }

    /**
     * Возвращает текст для 404 страницы админки
     * @return string
     */
    public function getAdmin404Content(){

        $tplName = 'admin_404.twig';
        return $this->getAdminSectionContent($tplName);
    }

    /**
     * Возвращает текст для 403 страницы админки
     * @return string
     */
    public function getAdmin403Content(){

        $tplName = 'admin_403.twig';
        return $this->getAdminSectionContent($tplName);
    }

    /**
     * Возвращает текст для раздела админки
     * @param $tplName string Шаблон
     * @return string
     */
    public function getAdminSectionContent($tplName) {

        $tplPath = ABS_PATH.'install/templates/';
        $data['ln'] = Language::getDictionary('custom');

        return Templater::render($tplPath, $tplName, $data);
    }

    /**
     * Возвращает темы по пути
     * @param $path string Путь к шаблонам
     * @return array
     */
    private function getThemes($path){

        $output = array();
        if (!file_exists($path)) return $output;

        $themes = scandir($path);
        foreach ($themes as $theme) {
            if (is_dir($path.$theme) && $theme[0] != '.') {
                $output[] = $theme;
            }
        }

        return $output;
    }

    /**
     * Возвращает темы сайта
     * @return array
     */
    public function getSiteThemes(){
        return $this->getThemes(ABS_PATH.'templates/');
    }

    /**
     * Возвращает темы админки
     * @return array
     */
    public function getAdminThemes(){
        return $this->getThemes(ABS_PATH.'admin/templates/');
    }

    /**
     * Существует ли файл конфигурации
     * @return bool
     */
    public function issetConfig(){
        return file_exists(ABS_PATH.'config.php');
    }

    /**
     * Проверяет подключение к БД
     * @param $dbConfig stdClass Объект конфигурации доступа к БД
     * @return bool
     */
    public function checkDBConnect($dbConfig){
        $result = @new mysqli($dbConfig->dbhost, $dbConfig->dbuser, $dbConfig->dbpass, $dbConfig->dbname);
        return !$result->connect_error;
    }

    /**
     * Обновляет параметры
     * @param $params array Параметры
     */
    public function updateParams($params){
        foreach ($params as $name => $value) {
            $this->updateParam($name, $value);
        }
    }

    /**
     * Обновлят параметра
     * @param $name string Имя параметра
     * @param $value string Значение параметра
     * @return mixed
     */
    public function updateParam($name, $value){

        $param = new stdClass();
        $param->name = $name;
        $param->value = $value;
        return $this->db->save('parameters', $param, 'name');
    }

    /**
     * Возвращает языки
     * @return array
     */
    public function getLanguages(){

        return array(
            0 => array(
                'title' => 'Русский',
                'value' => 'russian',
                'selected' => true
            ),
            1 => array(
                'title' => 'English',
                'value' => 'english'
            )
        );
    }

    /**
     * Запрещает доступ к разделу
     * @param $policyId int ID политики доступа
     * @param $itemId int ID раздела
     * @return bool
     */
    public function setDenySection($policyId, $itemId) {

        $policyDeny = new stdClass();
        $policyDeny->policy_id = $policyId;
        $policyDeny->section_id = $itemId;

        return $this->db->insert('users_policy_deny', $policyDeny);
    }

    /**
     * Добавляет админский модуль
     * @param $name string Имя модуля
     * @param $label string Метка модуля
     * @param $title string Заголовок модуля
     * @param $parameters array Массив параметров
     * @return bool
     */
    public function addAdminModule($name, $label, $title, $parameters){

        $module = new stdClass();
        $module->name = $name;
        $module->label = $label;
        $module->title = $title;
        $module->active = 1;
        $module->hide = 1;

        $moduleId = $this->db->insert('modules', $module);

        if (!empty($parameters)) {

            foreach ($parameters as $parameter) {
                $moduleParam = (object) $parameter;
                $moduleParam->module_id = $moduleId;
                $this->db->insert('modules_parameters', $moduleParam);
            }
        }

        return $moduleId;
    }

    /**
     * Устанавливает админские модули в раздел
     * @param $sectionId int ID раздела
     * @return void
     */
    public function initAdminModulesOnSection($sectionId){

        if (!empty($this->adminModules)) {
            foreach ($this->adminModules as $moduleId) {

                $sectionModule = new stdClass();
                $sectionModule->module_id = $moduleId;
                $sectionModule->item_id = $sectionId;
                $this->db->insert('section_modules', $sectionModule);
            }
        }
    }

    /**
     * Добавляет раздел компонента в системе управления
     * @param $componentName string Имя компонента
     * @param $menuId int ID меню
     * @param $title string Заголовок раздела
     * @param $alias string Псевдоним раздела
     * @param $ordering int Порядок раздела
     * @return bool
     */
    public function addComponentSection($componentName, $menuId, $title, $alias, $ordering){

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = $componentName;
        $item->alias = $alias;
        $item->active = 1;
        $item->visible = 1;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = $ordering;
        $item->hide = 1;
        $itemId = $this->db->insert('menu_items', $item);

        return $itemId;
    }

    /**
     * Добавляет параметр компонента
     * @param $value string Значение параметра
     * @param $componentName string Компонент
     * @param $itemId string Раздел
     * @param $paramName string Имя параметра
     * @param $paramType string Тип параметра
     * @param $paramTitle string Заголовок параметра
     */
    public function addComponentParam($value, $componentName, $itemId, $paramName, $paramType, $paramTitle) {

        $componentParam = new stdClass();
        $componentParam->component = $componentName;
        $componentParam->item_id = $itemId;
        $componentParam->name = $paramName;
        $componentParam->type = $paramType;
        $componentParam->title = $paramTitle;
        $componentParam->value = $value;
        $this->db->insert('components_parameters', $componentParam);
    }

    /**
     * Добавляет параметр раздела
     * @param $itemId int ID раздела
     * @param $paramName string Имя параметра
     * @param $paramType string Тип параметра
     * @param $paramTitle string Заголовок параметра
     * @param $paramValue string Значение параметра
     * @return mixed
     */
    public function addSectionParam($itemId, $paramName, $paramType, $paramTitle, $paramValue) {

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = $paramName;
        $sectionParam->type = $paramType;
        $sectionParam->title = $paramTitle;
        $sectionParam->value = $paramValue;
        return $this->db->insert('section_parameters', $sectionParam);
    }

    /**
     * Добавляет заголовок страницы
     * @param $itemId int ID раздела
     * @param $title string Заголовок страницы
     * @return mixed
     */
    public function addSectionTitle($itemId, $title) {
        return $this->addSectionParam($itemId, 'title', 'text', 'menueditor_pagetitle', $title);
    }

    /**
     * Устанавливает админский компонент в левое меню
     * @param $componentName string Имя компонента
     * @param $sectionTitle string Заголовок раздела
     * @param $alias string Псевдоним раздела
     * @return void
     */
    public function setupAdminComponent($componentName, $sectionTitle, $alias){

        $this->leftComponentOrdering++;
        $sectionId = $this->addComponentSection($componentName, $this->leftAdminMenuId, $sectionTitle, $alias,
            $this->leftComponentOrdering);
        $this->initAdminModulesOnSection($sectionId);
        $this->setDenySection(Config::$defaultPolicy, $sectionId);
        $this->addSectionTitle($sectionId, $sectionTitle);
    }

    /**
     * Устанавливает админский компонент в верхнее меню
     * @param $componentName string Имя компонента
     * @param $sectionTitle string Заголовок раздела
     * @param $alias string Псевдоним раздела
     * @param $order int Порядок раздела
     * @return void
     */
    public function setupSystemComponent($componentName, $sectionTitle, $alias, $order){

        $sectionId = $this->addComponentSection($componentName, $this->topAdminMenuId, $sectionTitle, $alias, $order);
        $this->initAdminModulesOnSection($sectionId);
        $this->setDenySection(Config::$defaultPolicy, $sectionId);
        $this->addSectionTitle($sectionId, $sectionTitle);
    }
}