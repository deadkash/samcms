<?php
/**
 * Представление карты сайта
 *
 * @project SamCMS
 * @package Sitemap
 * @author Kash
 * @date 27.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SitemapViewSitemap extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function display(){

        $this->setModel('Sitemap');
        $this->setTemplate('sitemap.twig');

        $menuItems = $this->model->getSitemapItems();
        $this->setValue('menus', $menuItems);

        return $this->render();
    }
}