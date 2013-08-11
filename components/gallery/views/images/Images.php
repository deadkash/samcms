<?php
/**
 * Представление списка изображений
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryViewImages extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка кода
     * @return string
     */
    public function display() {

        $this->setModel('Gallery');
        $this->setTemplate('gallery.twig');

        //Текущая сессия
        $parameters = Parameters::getComponentParameters($this->component, $this->itemId);
        $sessionId = $parameters['session_id'];
        $session = $this->model->getSession($sessionId);
        $this->setValue('session', $session);
        $minName = $parameters['min_name'];
        $maxName = $parameters['max_name'];

        //Список фотографий
        $images = $this->model->getImages($sessionId);
        foreach ($images as &$image) {
            if (isset($image[$maxName])) $image['max'] = $image[$maxName];
            if (isset($image[$minName])) $image['min'] = $image[$minName];
        }
        $this->setValue('images', $images);

        $document = Document::get();
        $document->addCSS('/components/gallery/assets/css/main.css');
        $document->addCSS('/lib/fancybox/jquery.fancybox.css');
        $document->addJS('/lib/fancybox/jquery.fancybox.pack.js');
        $document->addJS('/components/gallery/assets/js/fancy-init.js');

        return $this->render();
    }
}