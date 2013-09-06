<?php
/**
 * Загрузка изображения
 *
 * @project SamCMS
 * @package Editors
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ImageEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/image/image.twig';

    /**
     * Данные для шаблонизатора
     * @var array
     */
    protected $data = array();

    /**
     * Возвращает html код редактора
     * @param mixed $param Параметр
     * @return string
     */
    public function render($param) {
        return parent::render($param);
    }
}