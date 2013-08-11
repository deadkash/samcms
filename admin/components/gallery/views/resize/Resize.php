<?php
/**
 * Представление редактирования размеров изображения
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 16.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryViewResize extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка
     * @return string
     */
    public function display(){

        $this->setModel('Photo');
        $this->setTemplate('resize.twig');

        //Загрузка оригинального изображения
        $imageId = Request::getInt('image_id');
        $image = $this->model->getImageById($imageId);
        $this->setValue('image', $image);
        $fileName = $image->image;
        list($realWidth, $realHeight, $type) = @getimagesize(ABS_PATH.$fileName);

        //Загрузка размеров
        $sessionId = Request::getInt('session_id');
        $this->setValue('session_id', $sessionId);
        $sizes = $this->getModel('size')->getSizesBySessionId($sessionId);

        $sizes[] = GalleryConsts::getDefaultSize($sessionId);

        foreach ($sizes as &$size) {

            //Если не задана ширина или высота
            if (empty($size->width)) $size->width = round($realWidth * $size->height / $realHeight);
            if (empty($size->height)) $size->height = round($realHeight * $size->width / $realWidth);

            if ($realWidth <= $size->width) $size->width = $realWidth;
            if ($realHeight <= $size->height) $size->height = $realHeight;

            if ($size->width >= 970) {

                $size->height = round(970 * $size->height / $size->width);
                $size->width = 970;
            }

        }
        $this->setValue('sizes', $sizes);

        $document = Document::get();
        $document->addJS('/lib/jcrop/js/jquery.Jcrop.min.js');
        $document->addCSS('/lib/jcrop/css/jquery.Jcrop.css');

        return $this->render();
    }
}