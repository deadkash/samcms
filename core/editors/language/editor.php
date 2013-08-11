<?php

/**
 * Язык системы
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 04.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class LanguageEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/language/template.twig';

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

        $query = "SELECT `name`,`title`
                    FROM `language`;";
        $this->db->setQuery($query);

        $languages = $this->db->getObjectList();
        foreach ($languages as &$language) {
            $language->selected = ($language->name == $param->default);
        }

        return $languages;
    }
}