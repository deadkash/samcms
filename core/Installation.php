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

class Installation extends Core {

    /** @var string Разделитель sql запросов */
    private $sqlDelimiter = ';';

    /** @var array Параметры для файла конфигурации */
    private $configParams = array();

    /**
     * Конструктор
     */
    public function __construct() {
        if ($this->issetConfig()) {
            $this->db = DB::create();
        }
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
     * @param $componentsPath string путь к компонентам
     * @return array
     */
    private function getComponentsAndModules($componentsPath) {

        $items = scandir($componentsPath);
        $components = array();
        foreach ($items as $item) {

            if ($this->isComponentDir($item, $componentsPath)) {
                $componentPath = $componentsPath.$item.'/';
                $componentName = ucfirst($item);

                $components[] = array(
                    'path' => $componentPath,
                    'name' => $componentName
                );
            }
        }

        return $components;
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
}