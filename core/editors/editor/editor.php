<?php

/**
 * Визуальный редактор
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 23.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class EditorEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/editor/template.twig';

    /**
     * Данные для шаблонизатора
     * @var array
     */
    protected $data = array();

    /**
     * Возвращает html код редактора
     *
     * @param string $param
     * @return string
     */
    public function render($param) {

        $document = Document::get();
        $document->addJS('/lib/tinymce404/tinymce.min.js');

        return parent::render($param);
    }
}