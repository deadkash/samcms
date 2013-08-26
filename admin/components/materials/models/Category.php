<?php

/**
 * Модель категории материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsModelCategory extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавляет новую категорию
     * @param $category
     * @return bool
     */
    public function addCategory($category) {
        return $this->db->insert('materials_categories', $category);
    }

    /**
     * Возвращает категории
     * @return array|bool
     */
    public function getCategories() {

        $query = "SELECT `id`, `title`, `description`
                    FROM `materials_categories`
                ORDER BY `title`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
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

    /**
     * Обновляет категорию
     * @param $category
     * @return bool
     */
    public function updCategory($category) {
        return $this->db->save('materials_categories', $category, 'id');
    }

    /**
     * Удаляет категории
     * @param $categories
     * @return bool
     */
    public function deleteCategories($categories) {
        return $this->db->delete('materials_categories', 'id', $categories, 'list');
    }
}