<?php
/**
 * Представление добавления
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryViewAdd extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка кода
     * @return string
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'session':
                return $this->showAddSession();
                break;

            case 'size':
                return $this->showAddSize();
                break;

            case 'photo':
                return $this->showAddPhoto();
                break;

            default:
                return $this->showAddSession();
                break;
        }
    }

    /**
     * Добавление новой сессии
     * @return string
     */
    private function showAddSession() {

        //Модель и шаблон
        $this->setModel('Session');
        $this->setTemplate('add_session.twig');

        //Поля сессии
        $fields = GalleryConsts::getSessionFields();
        foreach ($fields as &$field) {
            /** @var $field Field */
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'session','view'=>'add'));
        $this->setValue('url', $postUrl);

        return $this->render();
    }

    /**
     * Добавление нового размера
     * @return string
     */
    private function showAddSize() {

        //Модель и шаблон
        $this->setModel('size');
        $this->setTemplate('add_size.twig');

        //Текущая сессия
        $sessionId = Request::getInt('session_id');
        $this->setValue('session_id', $sessionId);

        //Поля размера
        $fields = GalleryConsts::getSizeFields();
        foreach ($fields as &$field) {
            /** @var $field Field */
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'size','view'=>'add','session_id'=>$sessionId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }

    /**
     * Добавление новой фотографии
     * @return string
     */
    private function showAddPhoto() {

        //Модель и шаблон
        $this->setModel('photo');
        $this->setTemplate('add_photo.twig');

        //Текущая сессия
        $sessionId = Request::getInt('session_id');
        $this->setValue('session_id', $sessionId);

        //Поля фотографии
        $fields = GalleryConsts::getPhotoFields();
        foreach ($fields as &$field) {
            /** @var $field Field */
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'photo','view'=>'add','session_id'=>$sessionId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }
}