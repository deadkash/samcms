<?php

/**
 * Набор форм
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class FormEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/form/template.twig';

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

        $query = "SELECT `id`,`title`
                    FROM `forms`;";
        $this->db->setQuery($query);

        $forms = $this->db->getObjectList();
        foreach ($forms as &$form) {
            $form->selected = ($form->id == $param->default);
        }

        return $forms;
    }
}