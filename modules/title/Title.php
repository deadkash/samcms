<?php

/**
 * Модуль заголовка h1
 *
 * @author Kash
 * @project SamCMS
 * @package Title
 * @version 0.2.0
 * @date 22.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Title extends Module {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'title/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Название модуля
     * @var string
     */
    public $name = 'Title';

    /**
     * Отрисовка кода
     * @return string
     */
    public function render() {

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        $item = Parameters::getItemParameters($this->itemId);
        $this->data['title'] = $item->title;

        $parameters = Parameters::getSectionParameters($this->itemId);
        if (isset($parameters['titleh1']) && !empty($parameters['titleh1'])) {
            $this->data['title'] = $parameters['titleh1'];
        }

        return parent::render();
    }
}