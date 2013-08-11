<?php

/**
 * Представление xml карты сайта
 *
 * @project SamCMS
 * @package Sitemap
 * @author Kash
 * @date 10.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SitemapViewXml extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка
     * @return void
     */
    public function display() {

        $this->setModel('Sitemap');

        $document = Document::get();
        $document->setTplPath(ROOT_PATH.'components/sitemap/views/xml/templates/');
        $document->setTemplate('xml.twig');
        $document->setContentType('application/xml');

        $menuItems = $this->model->getXMLSitemapItems();
        $document->setValue('items', $menuItems);

        $document->render();
        exit;
    }
}