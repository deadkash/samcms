<?php

/**
 * Модель параметро
 *
 * @package Options
 * @project SamCMS
 * @author Kash
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class OptionsModelOptions extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает список параметров
     * @return array|bool
     */
    public function getParameters() {

        $query = "SELECT `p`.`name`,
                         `p`.`value`,
                         `p`.`type`,
                         `p`.`title`,
                         `p`.`group_id`,
                         `pg`.`title` AS `group_title`
                    FROM `parameters` AS `p`
                    JOIN `parameters_group` AS `pg`
                      ON `p`.`group_id`=`pg`.`id`
                   WHERE `p`.`hide`=0
                ORDER BY `pg`.`ordering`,`p`.`ordering`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает параметры по минимуму
     * @return array|bool
     */
    public function getParams() {

        $query = "SELECT `p`.`name`,
                         `p`.`value`
                    FROM `parameters` AS `p`
                   WHERE `p`.`hide`=0;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Сохраняет параметры
     * @param $parameters
     */
    public function saveParameters($parameters) {

        foreach ($parameters as $parameter) {
            $this->db->save('parameters', $parameter, 'name');
        }
    }
}