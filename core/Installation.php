<?php
/**
 * Класс установки приложения
 *
 * @project SamCMS
 * @package Installation
 * @author Kash
 * @since 0.2.4
 * @date 17.08.13
 */

class Installation extends Core {

    /** @var string Разделитель sql запросов */
    private $sqlDelimiter = ';';

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
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

        $intallClass = $this->getElementInstallClass($elementName, $elementPath);
        if (!$intallClass) return false;

        return $intallClass->install();
    }

    /**
     * @param $elementName
     * @param $elementPath
     * @return mixed
     */
    private function getElementInstallClass($elementName, $elementPath) {

        $installPath = $elementPath.'Install.php';
        if (!file_exists($installPath)) return false;

        require_once($installPath);

        $installClass = $elementName.'Install';
        if (!class_exists($installClass)) return false;

        return new $installClass();
    }

}