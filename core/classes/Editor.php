<?php

/**
 * Заготовка для редактора
 *
 * @author Kash
 * @package Class
 * @project SamCMS
 * @date 04.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
abstract class Editor {

    /**
     * Путь к шаблону редактора
     * @var string
     */
    protected $tplPath = '';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Отрисовка кода
     * @param $param
     * @return string
     */
    public function render($param) {
        $this->data['param'] = $param;
        return Templater::render(ABS_PATH.'core', $this->tplPath, $this->data);
    }
}