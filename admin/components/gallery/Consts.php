<?php
/**
 * Константы галереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryConsts {

    /**
     * Возвращает поля фотосессии
     * @return array
     */
    public static function getSessionFields(){

        $fields = array();

        //Название
        $title = new Field();
        $title->setName('title')
              ->setTitle('gallery_title')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        //Описание
        $description = new Field();
        $description->setName('description')
                    ->setTitle('gallery_description')
                    ->setType('editor')
                    ->setDefault('')
                    ->setHeight(300);
        $fields[] = $description;

        return $fields;
    }

    /**
     * Возвращает поля размера
     * @return array
     */
    public static function getSizeFields() {

        $fields = array();

        $title = new Field();
        $title->setName('title')
              ->setTitle('gallery_title')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        $name = new Field();
        $name->setName('name')
             ->setTitle('gallery_name')
             ->setType('text')
             ->setClass('input-xlarge')
             ->setDefault('')
             ->setRequired(true)
             ->setValidation('latin');
        $fields[] = $name;

        $width = new Field();
        $width->setName('width')
              ->setTitle('gallery_width')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('0')
              ->setValidation('integer');
        $fields[] = $width;

        $height = new Field();
        $height->setName('height')
               ->setTitle('gallery_height')
               ->setType('text')
               ->setClass('input-xlarge')
               ->setDefault('0')
               ->setValidation('integer');
        $fields[] = $height;

        return $fields;
    }

    /**
     * Возвращает поля фотографии
     * @return array
     */
    public static function getPhotoFields(){

        $fields = array();

        $title = new Field();
        $title->setName('title')
              ->setTitle('gallery_title')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        $description = new Field();
        $description->setName('description')
                    ->setTitle('gallery_description')
                    ->setType('editor')
                    ->setDefault('')
                    ->setHeight(200);
        $fields[] = $description;

        $image = new Field();
        $image->setName('image')
              ->setTitle('gallery_image')
              ->setType('image')
              ->setDefault('')
              ->setRequired(true)
              ->setValidation('image')
              ->setSize(10485760);
        $fields[] = $image;

        return $fields;
    }

    /**
     * Возвращает размер по умолчанию
     * @param $sessionId
     * @return stdClass
     */
    public static function getDefaultSize($sessionId) {

        $defaultSize = new stdClass();
        $defaultSize->id = 0;
        $defaultSize->session_id = $sessionId;
        $defaultSize->title = 'Default';
        $defaultSize->name = 'default';
        $defaultSize->width = 260;
        $defaultSize->height = 180;

        return $defaultSize;
    }
}