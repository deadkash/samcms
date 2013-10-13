<?php
/**
 * Плагин для поиска по статическим страницам
 *
 * @project SamCMS
 * @package Plugins
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SearchContent extends Plugin {

    /**
     * Обновляет элемент
     * @param $data
     * @param $itemId
     */
    public function updateItem($data, $itemId) {

        $index = $this->getTextValue($data);
        $itemParameters = Parameters::getItemParameters($itemId);
        $title = $itemParameters->title;
        $href = 'id='.$itemId;

        $db = DB::create();

        $title = $db->escape($title);
        $index = $db->escape($index);
        $itemId = (int) $itemId;

        $query = "INSERT INTO `search` (`title`,`index`,`href`,`element_id`,`type`,`modified`)
                  VALUES ('$title','$index','$href',$itemId,'content', NOW())
                  ON DUPLICATE KEY UPDATE `title`='$title',
                                          `index`='$index',
                                          `href`='$href',
                                          `element_id`=$itemId,
                                          `modified`=NOW();";
        $db->query($query);
    }

    /**
     * Возвращает поле с текстом
     * @param $data
     * @return bool
     */
    private function getTextValue($data) {

        $output = false;
        foreach ($data as $field) {
            if ($field->name == 'text') {
                $output = $field->value;
            }
        }

        return $output;
    }
}