<?php

/**
 * Модель материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsModelMaterial extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавляет материал
     * @param $material
     * @return bool
     */
    public function addMaterial($material) {

        $materialId = $this->db->insert('materials', $material);
        $material->id = $materialId;
        $this->updateSearchIndex($material);

        return $materialId;
    }

    /**
     * Сохраняем материал
     * @param $material
     * @return bool
     */
    public function updMaterial($material) {

        $result = $this->db->save('materials', $material, 'id');
        $this->updateSearchIndex($material);

        return $result;
    }

    /**
     * Обновляет поисковый индекс для материала
     * @param $data
     */
    public function updateSearchIndex($data) {

        $plugin = $this->getSearchPlugin();
        if ($plugin && method_exists($plugin, 'updateMaterial')) {
            $plugin->updateMaterial($data);
        }
    }

    /**
     * Возвращает объект поискового плагина материалов
     * @return mixed
     */
    private function getSearchPlugin() {

        $pluginPath = PLUGINS_PATH.'search/Materials.php';
        $pluginClass = 'SearchMaterials';
        if (file_exists($pluginPath)) {

            require_once($pluginPath);

            if (class_exists($pluginClass, false)) {
                return new $pluginClass();
            }
        }

        return false;
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
                         `mc`.`title` AS `category_title`
                    FROM `materials` AS `m`
               LEFT JOIN `materials_categories` AS `mc`
                      ON (`m`.`category_id`=`mc`.`id`)";

        if ($categoryId) {
            $query .= " WHERE `m`.`category_id`=".$categoryId;
        }
        $query .= " ORDER BY `m`.`date` DESC
                       LIMIT ".($page * $onPage).",". $onPage.";";
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
     * @return array|bool
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
                         `m`.`meta_keywords`,
                         `m`.`seo_frequency`,
                         `m`.`seo_priority`
                    FROM `materials` AS `m`
                   WHERE `m`.`id`=".$materialId.";";

        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Удаляет материалы
     * @param $materials
     * @return bool
     */
    public function deleteMaterials($materials) {
        $this->deleteSearchIndex($materials);
        return $this->db->delete('materials', 'id', $materials, 'list');
    }

    /**
     * Удаляет материалы из поискового индекса
     * @param $materials
     */
    public function deleteSearchIndex($materials) {

        foreach ($materials as $materialId) {
            $materialId = (int) $materialId;
            $query = "DELETE FROM `search`
                            WHERE `element_id`=".$materialId." AND `type`='materials';";
            $this->db->query($query);
        }
    }

    /**
     * Генерирует сео поля
     * @param $material
     */
    public function prepareSEO($material) {

        $seo = Seo::create();
        $category = $this->getCategory($material->category_id);
        $title = $material->title.' - '.$category->title;

        if (empty($material->meta_title)) {
            $material->meta_title = $seo->createTitle($title);
        }

        if (empty($material->meta_description)) {
            $material->meta_description = $seo->createDescription($material->title.' '.$category->title);
        }

        if (empty($material->meta_keywords)) {
            $material->meta_keywords = $seo->createKeywords($material->title.' '.$category->title);
        }

        return $material;
    }

    /**
     * Возвращает категорию
     * @param $categoryId
     * @return bool|stdClass
     */
    public function getCategory($categoryId) {
        $categoryModel = new MaterialsModelCategory();
        return $categoryModel->getCategoryById($categoryId);
    }
}