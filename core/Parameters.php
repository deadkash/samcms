<?php

/**
 * Класс для работы с параметрами, хранящимися в базе данных
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Parameters extends Core {

    /**
     * Таблица в базе данных
     * @var string
     */
    private static $table = 'parameters';

    /**
     * Массив для хранения параметров
     * @var array
     */
    public static $parameters;

    /**
     * Параметры раздела
     * @var array
     */
    public static $sectionParameters;

    /**
     * Параметры пункта меню
     * @var array
     */
    public static $itemParameters;

    /**
     * Возвращает параметр по имени
     *
     * @static
     * @param $name
     * @return mixed
     */
    public static function getParameter($name) {

        if (isset(self::$parameters[$name])) return self::$parameters[$name];

        $db = DB::create();

        $name = $db->escape($name);
        $query = "SELECT `value`
                    FROM `".self::$table."`
                   WHERE `name`='".$name."';";
        $db->setQuery($query);
        $data = $db->getObject();

        if (isset($data->value)) return $data->value;
        else return false;
    }

    /**
     * Возращает массив параметров
     *
     * @static
     * @return array
     */
    public static function getParameters() {

        $db = DB::create();

        $query = "SELECT `name`,
                         `value`
                    FROM `".self::$table."`;";
        $db->setQuery($query);
        $parameters = $db->getObjectList();
        if (!$parameters) return false;

        $output = array();
        foreach ($parameters as $parameter) {
            $output[$parameter->name] = $parameter->value;
        }

        //Кладем параметры в публичный массив для доступа
        self::$parameters = $output;
        return $output;
    }

    /**
     * Возвращает параметры разделы
     *
     * @static
     * @param $itemId
     * @param $all
     * @return array|bool
     */
    public static function getSectionParameters($itemId, $all = false) {

        if (isset(self::$sectionParameters[$itemId])) return self::$sectionParameters[$itemId];

        $itemId = (int) $itemId;
        $db = DB::create();

        $query = "SELECT *
                    FROM `section_parameters`
                   WHERE `section_id`=".$itemId."
                ORDER BY `id`;";
        $db->setQuery($query);
        $values = $db->getObjectList();

        if ($all) return $values;

        $output = array();
        foreach ($values as $value) {
            $output[$value->name] = $value->value;
        }

        self::$sectionParameters[$itemId] = $output;

        return $output;
    }

    /**
     * Возвращает параметр раздела
     * @param $itemId
     * @param $name
     * @return bool
     */
    public static function getSectionParameter($itemId, $name) {


        $itemId = (int) $itemId;
        $db = DB::create();
        $name = $db->escape($name);

        $query = "SELECT `value`
                    FROM `section_parameters`
                   WHERE `name`='".$name."' AND `section_id`=".$itemId.";";
        $db->setQuery($query);
        $param = $db->getObject();

        if (isset($param->value)) {
            return $param->value;
        }
        else return false;
    }

    /**
     * Возвращает параметры модуля, находящегося в определенной метке
     *
     * @param $label
     * @param $name
     * @param $all
     * @param $itemId
     * @return array
     */
    public static function getModuleParametersByLabel($label, $name, $itemId, $all = false) {

        $db = DB::create();
        $label = $db->escape($label);
        $name = $db->escape($name);
        $itemId = (int) $itemId;

        $query = "SELECT `mp`.`name`,
                         `mp`.`type`,
                         `mp`.`title`,
                         `mp`.`value`
                    FROM `modules` AS `m`
                    JOIN `modules_parameters` AS `mp`
                      ON `m`.`id`=`mp`.`module_id`
                    JOIN `section_modules` AS `sm`
                      ON `sm`.`module_id`=`m`.`id`
                   WHERE `m`.`label`='".$label."' AND `m`.`name`='".$name."' AND `sm`.`item_id`=".$itemId.";";
        $db->setQuery($query);
        $parameters = $db->getObjectList();

        if ($all) return $parameters;

        $output = array();
        foreach ($parameters as $param) {
            $output[$param->name] = $param->value;
        }

        return $output;
    }

    /**
     * Возвращает параметры компонента
     *
     * @param $component
     * @param $itemId
     * @return array|bool
     */
    public static function getAllComponentParameters($component, $itemId) {

        $db = DB::create();

        $component = $db->escape($component);
        $itemId = (int) $itemId;

        $query = "SELECT `id`,
                         `name`,
                         `type`,
                         `title`,
                         `value`,
                         `options`
                    FROM `components_parameters`
                   WHERE `component`='".$component."' AND `item_id`=".$itemId.";";
        $db->setQuery($query);

        return $db->getObjectList();
    }

    /**
     * Возвращает параметры компонента кратко
     *
     * @param $component
     * @param $itemId
     * @return array
     */
    public static function getComponentParameters($component, $itemId) {

        $db = DB::create();

        $component = $db->escape($component);
        $itemId = (int) $itemId;

        $query = "SELECT `name`,
                         `value`
                    FROM `components_parameters`
                   WHERE `component`='".$component."' AND `item_id`=".$itemId.";";
        $db->setQuery($query);
        $parameters = $db->getObjectList();

        $output = array();
        foreach ($parameters as $param) {
            $output[$param->name] = $param->value;
        }

        return $output;
    }

    /**
     * Возвращает параметры пункта меню
     * @param $itemId
     * @return bool|stdClass
     */
    public static function getItemParameters($itemId) {

        if (isset(self::$itemParameters[$itemId])) return self::$itemParameters[$itemId];
        $db = DB::create();

        $itemId = (int) $itemId;
        $query = "SELECT *
                    FROM `menu_items`
                   WHERE `id`=".$itemId.";";
        $db->setQuery($query);

        $item = $db->getObject();
        self::$itemParameters[$itemId] = $item;

        return $item;
    }
}