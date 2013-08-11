<?php
/**
 * Модель материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 11.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class MaterialsModelMain extends Model {

    /**
     * Класс роутера
     * @var Router
     */
    private $router;

    /**
     * Количество материалов на странице
     * @var int
     */
    public $onPage = 10;

    /**
     * Конструктор
     */
    public function __construct(){
        $this->router = Router::create();
        parent::__construct();
    }

    /**
     * Возвращает материалы
     * @param $categoryId
     * @param $page
     * @param $onPage
     * @return array|bool
     */
    public function getMaterials($categoryId, $page, $onPage) {

        $categoryId = (int) $categoryId;
        $page = (int) $page;
        $onPage = (int) $onPage;

        $query = "SELECT SQL_CALC_FOUND_ROWS
                         `m`.`id`,
                         `m`.`title`,
                         `m`.`category_id`,
                         `m`.`date`,
                         `m`.`preview`,
                         `mc`.`title` AS `category_title`
                    FROM `materials` AS `m`
               LEFT JOIN `materials_categories` AS `mc`
                      ON (`m`.`category_id`=`mc`.`id`)
                   WHERE `m`.`category_id`=".$categoryId."
                ORDER BY `m`.`date` DESC
                   LIMIT ".($page * $onPage).",". $onPage.";";

        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает материалы
     * @param $categoryId
     * @return array|bool
     */
    public function getRSSMaterials($categoryId) {

        $categoryId = (int) $categoryId;

        $query = "SELECT SQL_CALC_FOUND_ROWS
                         `m`.`id`,
                         `m`.`title`,
                         `m`.`category_id`,
                         `m`.`date`,
                         `m`.`preview`,
                         `mc`.`title` AS `category_title`
                    FROM `materials` AS `m`
               LEFT JOIN `materials_categories` AS `mc`
                      ON (`m`.`category_id`=`mc`.`id`)
                   WHERE `m`.`category_id`=".$categoryId."
                ORDER BY `m`.`date` DESC;";

        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает общее количество материалов
     * @return bool
     */
    public function getMaterialsCount() {

        $query = "SELECT FOUND_ROWS() AS `count`;";
        $this->db->setQuery($query);
        $count = $this->db->getObject();

        if (isset($count->count)) return $count->count;
        else return false;
    }

    /**
     * Возвращает материал по id
     * @param $materialId
     * @return mixed
     */
    public function getMaterialById($materialId) {

        $materialId = (int) $materialId;
        $query = "SELECT `m`.`id`,
                         `m`.`title`,
                         `m`.`category_id`,
                         `m`.`date`,
                         `m`.`preview`,
                         `m`.`fulltext`,
                         `m`.`meta_title`,
                         `m`.`meta_description`,
                         `m`.`meta_keywords`
                    FROM `materials` AS `m`
                   WHERE `m`.`id`=".$materialId.";";

        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Возвращает категорию
     * @param $categoryId
     * @return bool|stdClass
     */
    public function getCategoryById($categoryId) {

        $categoryId = (int) $categoryId;
        $query = "SELECT `id`,`title`,`description`
                    FROM `materials_categories`
                   WHERE `id`=".$categoryId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }
}