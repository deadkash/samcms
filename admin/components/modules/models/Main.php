<?php

/**
 * Модель
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesModelMain extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает типы новых модулей
     * @return array|bool
     */
    public function getModulesTypes() {

        $query = "SELECT `name`,
                         `title`,
                         `params`
                    FROM `extensions`
                   WHERE `type`='module';";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает модуль по имени
     *
     * @param $name
     * @return bool|stdClass
     */
    public function getExtensionByName($name) {

        $name = $this->db->escape($name);
        $query = "SELECT `name`,
                         `title`,
                         `params`
                   FROM `extensions`
                  WHERE `name`='".$name."';";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Валидация основных параметров модуля
     * @param $module
     * @return bool
     */
    public function validateMainParameters($module) {

        $valid = true;

        //Если пустой заголовок
        if (empty($module->title)) {
            $valid = false;
            Messages::addMessage('empty_title', 'alert-danger', Language::translate('modules_msg_empty_title'));
        }

        //Если пустая метка
        if (empty($module->label)) {
            $valid = false;
            Messages::addMessage('empty_label', 'alert-danger', Language::translate('modules_msg_empty_label'));
        }

        //Если метка уже занята
        if (!isset($module->id)) $module->id = false;
        if (!empty($module->label) && $this->issetLabel($module->label, $module->id)) {
            Messages::addMessage('label_exists', 'alert-warning', Language::translate('modules_msg_label_exists'));
        }

        return $valid;
    }

    /**
     * Проверка сущестовании метки
     *
     * @param $label
     * @param bool $moduleId
     * @return bool
     */
    public function issetLabel($label, $moduleId = false) {

        $label = $this->db->escape($label);
        $query = "SELECT `id`
                    FROM `modules`
                   WHERE `label`='".$label."' AND `hide`=0";

        if ($moduleId) {
            $query .= " AND `id`!=".$moduleId;
        }
        $query .= ";";
        $this->db->setQuery($query);

        $labels = $this->db->getObjectList();

        if ($labels) return true;
        else return false;
    }

    /**
     * Сохраняет основные параметры модуля
     * @param $module
     * @return bool
     */
    public function saveMainParameters($module) {
        return $this->db->insert('modules', $module);
    }

    /**
     * Обновляет основные параметры модуля
     *
     * @param $module
     * @return bool
     */
    public function updMainParameters($module) {
        return $this->db->save('modules', $module, 'id');
    }

    /**
     * Сохраняет параметры модуля
     * @param $parameters
     * @param $moduleId
     */
    public function saveModuleParameters($parameters, $moduleId) {

        foreach ($parameters as $parameter) {

            $parameter->module_id = $moduleId;
            unset($parameter->default);

            $this->db->insert('modules_parameters', $parameter);
        }
    }

    /**
     * Обновляет параметры модуля
     * @param $parameters
     * @param $moduleId
     */
    public function updModuleParameters($parameters, $moduleId) {

        foreach ($parameters as $parameter) {
            $parameter->module_id = $moduleId;
            $this->db->save('modules_parameters', $parameter, 'id');
        }
    }

    /**
     * Возвращает список модулей
     * @param $page
     * @param $onPage
     * @return array|bool
     */
    public function getModules($page, $onPage) {

        $query = "SELECT SQL_CALC_FOUND_ROWS
                         `m`.`id`,
                         `m`.`name`,
                         `m`.`label`,
                         `m`.`title`,
                         `m`.`active`,
                         `e`.`title` AS `module`
                    FROM `modules` AS `m`
               LEFT JOIN `extensions` AS `e`
                      ON `m`.`name`=`e`.`name`
                   WHERE `m`.`hide`=0
                ORDER BY `m`.`id`
                   LIMIT ".($page * $onPage).",". $onPage.";";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает общее количество материалов
     * @return bool
     */
    public function getModulesCount() {

        $query = "SELECT FOUND_ROWS() AS `count`;";
        $this->db->setQuery($query);
        $count = $this->db->getObject();

        if (isset($count->count)) return $count->count;
        else return false;
    }

    /**
     * Возвращает модуль по id
     *
     * @param $moduleId
     * @return bool|stdClass
     */
    public function getModuleById($moduleId) {

        $moduleId = (int) $moduleId;
        $query = "SELECT `m`.`id`,
                         `m`.`name`,
                         `m`.`label`,
                         `m`.`title`,
                         `m`.`active`,
                         `e`.`title` AS `module`
                    FROM `modules` AS `m`
               LEFT JOIN `extensions` AS `e`
                      ON `m`.`name`=`e`.`name`
                   WHERE `m`.`id`=".$moduleId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Возвращает параметры модуля по id
     * @param $moduleId
     * @return array|bool
     */
    public function getModuleParameters($moduleId) {

        $moduleId = (int) $moduleId;
        $query = "SELECT `id`,
                         `name`,
                         `type`,
                         `title`,
                         `value`,
                         `options`
                    FROM `modules_parameters`
                   WHERE `module_id`=".$moduleId.";";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Удаляет модули
     * @param $items
     * @return bool
     */
    public function deleteModules($items) {

        $this->db->delete('modules_parameters', 'module_id', $items, 'list');
        $this->db->delete('section_modules', 'module_id', $items, 'list');
        return $this->db->delete('modules', 'id', $items, 'list');
    }
}