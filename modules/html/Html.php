<?php

/**
 * Вывод html кода
 *
 * @project SamCMS
 * @package Html
 * @author Kash
 * @date 27.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Html extends Module {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'html/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'html';

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        $this->data = Parameters::getModuleParametersByLabel($this->label, $this->name, $this->itemId);
        return parent::render();
    }
}