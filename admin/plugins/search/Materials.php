<?php
/**
 * Плагин для поиска по материалам
 *
 * @project SamCMS
 * @package Plugins
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SearchMaterials extends Plugin {

    /**
     * Возвращает раздел с материалами категории
     * @param $categoryId
     * @return bool
     */
    private function getCategorySection($categoryId) {

        $categoryId = (int) $categoryId;
        $db = DB::create();
        $query = "SELECT `item_id`
                    FROM `components_parameters`
                   WHERE `component`='materials' AND `name`='category_id' AND `value`=".$categoryId."
                   LIMIT 1;";
        $db->setQuery($query);
        $item = $db->getObject();

        if (isset($item->item_id)) return $item->item_id;
        else return false;
    }

    /**
     * Обновляет поисковый индекс материала
     * @param $data
     */
    public function updateMaterial($data) {

        $db = DB::create();

        $title = $db->escape($data->title);
        $index = $db->escape($data->fulltext);
        $href = 'id='.$this->getCategorySection($data->category_id).'&material_id='.$data->id;

        $query = "INSERT INTO `search` (`title`,`index`,`href`,`element_id`,`type`,`modified`)
                  VALUES ('$title','$index','$href',$data->id,'materials', NOW())
                  ON DUPLICATE KEY UPDATE `title`='$title',
                                          `index`='$index',
                                          `href`='$href',
                                          `element_id`=$data->id,
                                          `modified`=NOW();";
        $db->query($query);
    }
}