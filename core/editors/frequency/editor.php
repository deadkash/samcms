<?php
/**
 * Частота обновления страницы
 *
 * @project SamCMS
 * @package Editor
 * @author Kash
 * @date 10.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FrequencyEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/frequency/frequency.twig';

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

            0 => array('id' => 'always', 'title' => ''),
            1 => array('id' => 'hourly', 'title' => ''),
            2 => array('id' => 'daily', 'title' => ''),
            3 => array('id' => 'weekly', 'title' => ''),
            4 => array('id' => 'monthly', 'title' => ''),
            5 => array('id' => 'yearly', 'title' => ''),
            6 => array('id' => 'never', 'title' => '')
        );

        foreach ($param->options as &$option) {
            $option['selected'] = ($option['id'] == $param->default);
        }
        return parent::render($param);
    }
}