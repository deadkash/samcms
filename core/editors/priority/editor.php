<?php
/**
 * Важность страницы
 *
 * @project SamCMS
 * @package Editor
 * @author Kash
 * @date 10.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class PriorityEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/priority/priority.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Отрисовка html кода
     * @param $param
     * @return string
     */
    public function render($param) {

        $param->options = array(

            0 => array('id' => '1.0', 'title' => ''),
            1 => array('id' => '0.9', 'title' => ''),
            2 => array('id' => '0.8', 'title' => ''),
            3 => array('id' => '0.7', 'title' => ''),
            4 => array('id' => '0.6', 'title' => ''),
            5 => array('id' => '0.5', 'title' => ''),
            6 => array('id' => '0.4', 'title' => ''),
            7 => array('id' => '0.3', 'title' => ''),
            9 => array('id' => '0.2', 'title' => ''),
            10 => array('id' => '0.1', 'title' => ''),
        );

        foreach ($param->options as &$option) {
            $option['selected'] = ($option['id'] == $param->default);
        }
        return parent::render($param);
    }
}