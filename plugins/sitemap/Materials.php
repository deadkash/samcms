<?php

/**
 * Расширение для карты сайта
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 10.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsSitemap extends Plugin {

    /**
     * Возвращает материалы
     * @param $item
     * @return array|bool
     */
    public function getItems($item) {

        $parameters = Parameters::getComponentParameters('materials', $item->id);
        $categoryId = (isset($parameters['category_id'])) ? $parameters['category_id'] : false;
        if (!$categoryId) return false;

        $router = Router::create();
        $materials = $this->getMaterials($categoryId);
        foreach ($materials as &$material) {

            $material->url = $router->getUrl(array(
                'id'=>$item->id,'material_id' => $material->id
            ));
            $material->modified = DatetimeHelper::getSitemapDate($material->date);
        }

        return $materials;
    }

    /**
     * Возвращает материалы
     * @param $categoryId
     * @return array|bool
     */
    private function getMaterials($categoryId) {

        $categoryId = (int) $categoryId;
        $query = "SELECT `id`,
                         `date`,
                         `title`,
                         `seo_frequency` AS `frequency`,
                         `seo_priority` AS `priority`
                    FROM `materials`
                   WHERE `category_id`=".$categoryId.";";
        $db = DB::create();
        $db->setQuery($query);

        return $db->getObjectList();
    }
}