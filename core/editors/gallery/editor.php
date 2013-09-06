<?php

/**
 * Выбор фотосессии
 *
 * @project SamCMS
 * @package Editor
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class GalleryEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/gallery/gallery.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Отрисовка html кода
     * @param mixed $param Параметр
     * @return string
     */
    public function render($param) {

        $param->options = $this->getParamOptions($param);
        return parent::render($param);
    }

    /**
     * Возвращает варианты параметра
     * @param $param mixed Параметр
     * @return array|bool
     */
    private function getParamOptions($param) {

        $db = DB::create();

        $query = "SELECT `id`, `title`
                    FROM `gallery_sessions`
                ORDER BY `title`;";
        $db->setQuery($query);

        $options = $db->getObjectList();
        if ($options) {
            foreach ($options as &$option) {
                $option->selected = ($option->id == $param->default);
            }
        }

        return $options;
    }
}