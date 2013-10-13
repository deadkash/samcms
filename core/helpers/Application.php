<?php

/**
 * Помощник приложения
 *
 * @project SamCMS
 * @author Kash
 * @package helpers
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class ApplicationHelper {

    /**
     * Возвращает путь к файлу модуля
     *
     * @static
     * @param $moduleName
     * @assert ('str') === '/home/kash/server/cinema/modules/str/str.php'
     * @return string
     */
    public static function getModulePath($moduleName) {
        return APP_PATH.'modules/'.strtolower($moduleName).'/'.$moduleName.'.php';
    }

    /**
     * Возвращает путь к файлу компонента
     *
     * @param $componentName
     * @return string
     */
    public static function getComponentPath($componentName) {
        return APP_PATH.'components/'.strtolower($componentName).'/'.$componentName.'.php';
    }

    /**
     * Показывает ошибку отсутствия расширения
     * @param $path
     */
    public static function setExtensionNotExists($path) {
        Messages::addMessage('extension_not_exists', 'alert-danger', '<strong>Error:</strong> Extension "'.$path.'" not exists!');
    }

    /**
     * Показывает ошибку отсутствия шаблона
     * @param $path
     */
    public static function setTemplateNotExists($path) {
        Messages::addMessage('template_not_exists', 'alert-danger', '<strong>Error:</strong> Template "'.$path.'" not exists!');
    }

    /**
     * Возвращает компонент раздела
     * @param $itemId
     * @return bool
     */
    public static function getItemComponent($itemId) {

        $db = DB::create();
        $itemId = (int) $itemId;

        $query = "SELECT `component`
                    FROM `menu_items`
                   WHERE `id`=".$itemId.";";
        $db->setQuery($query);
        $item = $db->getObject();

        if (isset($item->component)) return $item->component;
        else return false;
    }

    /**
     * Возвращает массив меток и модулей, привязанных пункту меню
     *
     * @param $itemId
     * @return array|bool
     */
    public static function getSectionModules($itemId) {

        $db = DB::create();
        $itemId = (int) $itemId;

        $query = "SELECT `m`.`label`,
                         `m`.`name`
                    FROM `section_modules` AS `sm`
                    JOIN `modules` AS `m`
                      ON `sm`.`module_id`=`m`.`id`
                   WHERE `sm`.`item_id`=".$itemId." AND `m`.`active`=1;";
        $db->setQuery($query);

        return $db->getObjectList();
    }

}
