<?php

/**
 * Заготовка для класса модели модуля
 *
 * @project SamCMS
 * @package class
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class Model {

    /**
     * Класс для работы с БД
     * @var DB
     */
    public $db;

    /**
     * Раздел, в котором запущен модуль
     * @var int
     */
    public $itemId;

    /**
     * Текущий компонент
     * @var string
     */
    public $component;

    /**
     * Конструктор
     */
    public function __construct() {
        $this->db = DB::create();
    }

    /**
     * Возвращает массив страниц
     *
     * @param $page int Текущая страница
     * @param $count int Количество элементов всего
     * @param $onPage int Количество на странице
     * @param $params array Дополнительные параметры
     * @return float
     */
    public function getPageLine($page, $count, $onPage, $params = array()) {

        $router = Router::create();
        $pages = ceil($count / $onPage);
        if ($pages <= 1) return array();

        $output = array();

        $page++;
        $urlParams = array_merge(array('id'=>$this->itemId), $params, array('page'=>$page - 1));
        $output[] = array(
            'title' => Language::translate('core_previous'),
            'href' => $router->getUrl($urlParams),
            'disabled' => ($page == 1)
        );

        for ($i = 1; $i <= $pages; $i++) {

            $urlParams = array_merge(array('id'=>$this->itemId), $params, array('page'=>$i));
            $output[] = array(
                'title' => $i,
                'href' => $router->getUrl($urlParams),
                'selected' => ($i == $page)
            );
        }

        $urlParams = array_merge(array('id'=>$this->itemId), $params, array('page'=>$page + 1));
        $output[] = array(
            'title' => Language::translate('core_next'),
            'href' => $router->getUrl($urlParams),
            'disabled' => ($page == $pages)
        );

        return $output;
    }
}