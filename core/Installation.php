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
     * @param int $leftAdminMenuId
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
     * @param int $topAdminMenuId
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
     * Добавляет параметр в конфиг
     * @param string $paramName
     * @param mixed $paramValue
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
     * @param $elementPath string путь к компонентам
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
     * @param $sqlPath
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

        $this->register($installClass);
        return $installClass->execute();
    }

    /**
     * Возвращает объект установщика компонента или модуля
     * @param $elementName
     * @param $elementPath
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
     * @param Install $install
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
     * @param $params
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
     * @param string $title
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
     * @param $title
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
     * @param $title
     * @return bool
     */
    public function addUserMenu($title){

        $menu = new stdClass();
        $menu->title = $title;
        $menu->hide = 0;

        return $this->db->insert('menu', $menu);
    }

    /**
     * Добавляет главный раздел системы управления
     * @param $title
     * @param $menuId
     * @param $content
     * @return bool
     */
    public function addAdminMainSection($title, $menuId, $content){

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Content';
        $item->alias = '';
        $item->active = 1;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 0;
        $item->hide = 1;

        $itemId = $this->db->insert('menu_items', $item);

        $componentParam = new stdClass();
        $componentParam->component = 'Content';
        $componentParam->item_id = $itemId;
        $componentParam->name = 'text';
        $componentParam->type = 'editor';
        $componentParam->title = 'content_code';
        $componentParam->value = $content;

        $this->db->insert('components_parameters', $componentParam);

        return $itemId;
    }

    /**
     * Создает главную страницу
     * @param $title
     * @param $menuId
     * @param $content
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

        $componentParam = new stdClass();
        $componentParam->component = 'Content';
        $componentParam->item_id = $itemId;
        $componentParam->name = 'text';
        $componentParam->type = 'editor';
        $componentParam->title = 'content_code';
        $componentParam->value = $content;
        $this->db->insert('components_parameters', $componentParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'title';
        $sectionParam->type = 'text';
        $sectionParam->title = 'menueditor_pagetitle';
        $sectionParam->value = Parameters::getParameter('meta_title');
        $this->db->insert('section_parameters', $sectionParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'description';
        $sectionParam->type = 'textarea';
        $sectionParam->title = 'menueditor_pagedescription';
        $sectionParam->value = Parameters::getParameter('meta_description');
        $this->db->insert('section_parameters', $sectionParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'keywords';
        $sectionParam->type = 'textarea';
        $sectionParam->title = 'menueditor_pagekeywords';
        $sectionParam->value = Parameters::getParameter('meta_keywords');
        $this->db->insert('section_parameters', $sectionParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'seo_frequency';
        $sectionParam->type = 'frequency';
        $sectionParam->title = 'core_frequency';
        $sectionParam->value = 'always';
        $this->db->insert('section_parameters', $sectionParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'seo_priority';
        $sectionParam->type = 'priority';
        $sectionParam->title = 'core_priority';
        $sectionParam->value = '1.0';
        $this->db->insert('section_parameters', $sectionParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'template';
        $sectionParam->type = 'text';
        $sectionParam->title = 'menueditor_pagetemplate';
        $sectionParam->value = 'index.twig';
        $this->db->insert('section_parameters', $sectionParam);

        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'titleh1';
        $sectionParam->type = 'text';
        $sectionParam->title = 'menueditor_titleh1';
        $sectionParam->value = '';
        $this->db->insert('section_parameters', $sectionParam);

        return $itemId;
    }

    /**
     * Добавляет 404 страницу в админку
     * @param $title
     * @param $menuId
     * @param $content
     * @return bool
     */
    public function addAdmin404Section($title, $menuId, $content){

        //Создание пункта меню
        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Content';
        $item->alias = '404';
        $item->active = 1;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 0;
        $item->hide = 1;
        $itemId = $this->db->insert('menu_items', $item);

        //Добавление текста в компонент Content
        $componentParam = new stdClass();
        $componentParam->component = 'Content';
        $componentParam->item_id = $itemId;
        $componentParam->name = 'text';
        $componentParam->type = 'editor';
        $componentParam->title = 'content_code';
        $componentParam->value = $content;
        $this->db->insert('components_parameters', $componentParam);

        //Подмена шаблона вывода
        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'template';
        $sectionParam->type = 'text';
        $sectionParam->title = 'menueditor_pagetemplate';
        $sectionParam->value = '404.twig';
        $this->db->insert('section_parameters', $sectionParam);

        return $itemId;
    }

    /**
     * Добавляет 403 страницу в админку
     * @param $title
     * @param $menuId
     * @param $content
     * @return bool
     */
    public function addAdmin403Section($title, $menuId, $content){

        //Создание пункта меню
        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Content';
        $item->alias = '403';
        $item->active = 1;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 0;
        $item->hide = 1;
        $itemId = $this->db->insert('menu_items', $item);

        //Добавление текста в компонент Content
        $componentParam = new stdClass();
        $componentParam->component = 'Content';
        $componentParam->item_id = $itemId;
        $componentParam->name = 'text';
        $componentParam->type = 'editor';
        $componentParam->title = 'content_code';
        $componentParam->value = $content;
        $this->db->insert('components_parameters', $componentParam);

        //Подмена шаблона вывода
        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'template';
        $sectionParam->type = 'text';
        $sectionParam->title = 'menueditor_pagetemplate';
        $sectionParam->value = '403.twig';
        $this->db->insert('section_parameters', $sectionParam);

        return $itemId;
    }

    /**
     * Добавляет страницу авторизации
     * @param $title
     * @param $menuId
     * @return bool
     */
    public function addAuthSection($title, $menuId){

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Auth';
        $item->alias = 'auth';
        $item->active = 1;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 0;
        $item->hide = 1;
        $itemId = $this->db->insert('menu_items', $item);

        $componentParam = new stdClass();
        $componentParam->component = 'Auth';
        $componentParam->item_id = $itemId;
        $componentParam->name = 'view';
        $componentParam->type = 'text';
        $componentParam->title = 'auth_view';
        $componentParam->value = 'Login';
        $this->db->insert('components_parameters', $componentParam);

        //Подмена шаблона вывода
        $sectionParam = new stdClass();
        $sectionParam->section_id = $itemId;
        $sectionParam->name = 'template';
        $sectionParam->type = 'text';
        $sectionParam->title = 'menueditor_pagetemplate';
        $sectionParam->value = 'auth.twig';
        $this->db->insert('section_parameters', $sectionParam);

        return $itemId;
    }

    /**
     * Создает страницу восстановления пароля
     * @param $title
     * @param $menuId
     * @return bool
     */
    public function addRecoverSection($title, $menuId){

        $item = new stdClass();
        $item->menu_id = $menuId;
        $item->title = $title;
        $item->component = 'Auth';
        $item->alias = 'recover';
        $item->active = 1;
        $item->visible = 0;
        $item->parent = 0;
        $item->level = 0;
        $item->ordering = 0;
        $item->hide = 1;

        $itemId = $this->db->insert('menu_items', $item);

        $componentParam = new stdClass();
        $componentParam->component = 'Auth';
        $componentParam->item_id = $itemId;
        $componentParam->name = 'view';
        $componentParam->type = 'text';
        $componentParam->title = 'auth_view';
        $componentParam->value = 'Recover';

        $this->db->insert('components_parameters', $componentParam);

        return $itemId;
    }

    /**
     * Возвращает текст для главной страницы админки
     * @return string
     */
    public function getAdminMainContent(){

        $tplPath = ABS_PATH.'install/templates/';
        $tplName = 'admin_content.twig';
        $data['ln'] = Language::getDictionary('custom');

        return Templater::render($tplPath, $tplName, $data);
    }

    /**
     * Возвращает текст для 404 страницы админки
     * @return string
     */
    public function getAdmin404Content(){

        $tplPath = ABS_PATH.'install/templates/';
        $tplName = 'admin_404.twig';
        $data['ln'] = Language::getDictionary('custom');

        return Templater::render($tplPath, $tplName, $data);
    }

    /**
     * Возвращает текст для 403 страницы админки
     * @return string
     */
    public function getAdmin403Content(){

        $tplPath = ABS_PATH.'install/templates/';
        $tplName = 'admin_403.twig';
        $data['ln'] = Language::getDictionary('custom');

        return Templater::render($tplPath, $tplName, $data);
    }

    /**
     * Возвращает темы по пути
     * @param $path
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
     * @param $dbConfig
     * @return bool
     */
    public function checkDBConnect($dbConfig){
        $result = @new mysqli($dbConfig->dbhost, $dbConfig->dbuser, $dbConfig->dbpass, $dbConfig->dbname);
        return !$result->connect_error;
    }

    /**
     * Обновляет параметры
     * @param $params
     */
    public function updateParams($params){

        foreach ($params as $name => $value) {
            $this->updateParam($name, $value);
        }
    }

    /**
     * Обновлят параметра
     * @param $name
     * @param $value
     * @return mixed
     */
    public function updateParam($name, $value){

        $name = $this->db->escape($name);
        $value = $this->db->escape($value);
        $query = "UPDATE `parameters`
                     SET `value`='".$value."'
                   WHERE `name`='".$name."';";
        return $this->db->query($query);
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
}