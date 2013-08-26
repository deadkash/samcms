<?php

/**
 * Поле select
 *
 * @project SamCMS
 * @package Editor
 * @author Kash
 * @date 26.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SelectEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/select/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Отрисовка html кода
     * @param string $param
     * @return string
     */
    public function render($param) {

        /** @var $param Field */
        if (is_array($param->options)) {
            foreach ($param->options as &$option) {
                $option['title'] = Language::translate($option['title']);
                $option['selected'] = ($option['id'] == $param->default);
            }
            return parent::render($param);
        }

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

        if (!isset($param->options)) return false;

        $db = DB::create();
        $table = $param->options;
        $table = $db->escape($table);

        $query = "SELECT `id`, `title`
                    FROM `".$table."`
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