<?php

/**
 * Редактирование
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 10.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class GalleryViewEdit extends View {

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
    public function display(){

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'session':
                return $this->showEditSession();
                break;

            case 'size':
                return $this->showEditSize();
                break;

            case 'photo':
                return $this->showEditPhoto();
                break;

            default:
                return $this->showEditSession();
                break;
        }
    }

    /**
     * Редактирование фотосессии
     * @return string
     */
    private function showEditSession() {

        //Установка модели и шаблона
        $this->setModel('Session');
        $this->setTemplate('edit_session.twig');

        //Загружаем форму
        $sessionId = Request::getInt('session_id');
        $session = $this->model->getSessionById($sessionId);
        $this->setValue('session_id', $sessionId);

        //Поля формы
        $fields = GalleryConsts::getSessionFields();
        foreach ($fields as &$field) {
            /** @var Field $field */
            $fieldName = $field->name;
            $field->default = $session->$fieldName;
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'session','view'=>'edit','session_id'=>$sessionId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }

    /**
     * Редактирование размера
     * @return string
     */
    private function showEditSize() {

        //Установка модели и шаблона
        $this->setModel('Size');
        $this->setTemplate('edit_size.twig');

        //Загружаем форму
        $sessionId = Request::getInt('session_id');
        $sizeId = Request::getInt('size_id');
        $size = $this->model->getSizeById($sizeId);
        $this->setValue('session_id', $sessionId);
        $this->setValue('size_id', $sizeId);

        //Поля формы
        $fields = GalleryConsts::getSizeFields();
        foreach ($fields as &$field) {
            /** @var Field $field */
            $fieldName = $field->name;
            $field->default = $size->$fieldName;
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'size','view'=>'edit','session_id'=>$sessionId,'size_id'=>$sizeId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }

    /**
     * Редактирование изображения
     * @return string
     */
    private function showEditPhoto() {

        //Установка модели и шаблона
        $this->setModel('Photo');
        $this->setTemplate('edit_photo.twig');

        //Загружаем форму
        $sessionId = Request::getInt('session_id');
        $imageId = Request::getInt('image_id');
        $image = $this->model->getImageById($imageId);
        $this->setValue('session_id', $sessionId);
        $this->setValue('image_id', $imageId);

        //Поля формы
        $fields = GalleryConsts::getPhotoFields();
        foreach ($fields as &$field) {
            /** @var Field $field */
            $fieldName = $field->name;
            $field->default = $image->$fieldName;
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'photo','view'=>'edit','session_id'=>$sessionId,'image_id'=>$imageId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }
}