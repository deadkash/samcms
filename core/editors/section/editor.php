<?php

/**
 * Набор разделов
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SectionEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/section/template.twig';

    /**
     * Данные для шаблонизатора
     * @var array
     */
    protected $data = array();

    /**
     * Конструктор
     */
    public function __construct() {

        $this->db = DB::create();
    }

    /**
     * Возвращает html код редактора
     *
     * @param string $param
     * @return string
     */
    public function render($param) {

        $param->options = $this->getParamOptions($param);
        return parent::render($param);
    }

    /**
     * Возвращает варианты параметра
     *
     * @param $param
     * @return array|bool
     */
    private function getParamOptions($param) {

        $options = $this->getItems(0,0);
        if ($options) {
            foreach ($options as &$option) {
                $option->selected = ($option->id == $param->default);
                $option->title = str_pad('', ($option->level * 2), '--', STR_PAD_LEFT).' '.$option->title;
            }
        }

        return $options;
    }

    /**
     * Возвращает пункты меню по его id
     *
     * @param $parentId
     * @param $itemId
     * @return array|bool
     */
    public function getItemsByMenuId($parentId, $itemId = false) {

        $parentId = (int) $parentId;
        $itemId = (int) $itemId;

        $query = "SELECT `m1`.`id`,
                         `m1`.`title`,
                         `m1`.`level`
                    FROM `menu_items` AS `m1`
                   WHERE `m1`.`parent`=".$parentId." AND `m1`.`id`!=".$itemId." AND `m1`.`hide`=0
                ORDER BY `m1`.`menu_id`,`m1`.`ordering`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает разделы рекурсивно
     *
     * @param $parentId
     * @param $itemId
     * @return array
     */
    public function getItems($parentId, $itemId = false) {

        $output = array();
        $items = $this->getItemsByMenuId($parentId, $itemId);
        foreach ($items as &$item) {
            $output[] = $item;
            $subitems = $this->getItems($item->id, $itemId);
            if ($subitems) {
                $output = array_merge($output, $subitems);
            }
        }

        return $output;
    }
}