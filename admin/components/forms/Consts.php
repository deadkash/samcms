<?php

/**
 * Константы форм
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class FormsConsts {

    /**
     * Возвращает поля формы
     * @return array
     */
    public static function getFormFields() {

        $fields = array();

        //Заголовок
        $title = new Field();
        $title->setName('title')
              ->setTitle('forms_title')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        //Название
        $name = new Field();
        $name->setName('name')
             ->setTitle('forms_name')
             ->setType('text')
             ->setClass('input-xlarge')
             ->setDefault('');
        $fields[] = $name;

        //Текст успешной отправки
        $successText = new Field();
        $successText->setName('success_text')
                    ->setTitle('forms_success_text')
                    ->setType('editor')
                    ->setDefault('')
                    ->setHeight(300);
        $fields[] = $successText;

        //Отправлять письмо админу
        $sendAdminEmail = new Field();
        $sendAdminEmail->setName('send_admin_email')
                       ->setTitle('forms_send_admin_email')
                       ->setType('checkbox')
                       ->setDefault('1');
        $fields[] = $sendAdminEmail;

        //E-mail администратора
        $adminEmail = new Field();
        $adminEmail->setName('admin_email')
                   ->setTitle('forms_admin_email')
                   ->setType('text')
                   ->setClass('input-xlarge')
                   ->setDefault('')
                   ->setValidation('email');
        $fields[] = $adminEmail;

        //Отправлять ответ
        $sendAnswer = new Field();
        $sendAnswer->setName('send_answer')
                   ->setTitle('forms_send_answer')
                   ->setType('checkbox')
                   ->setDefault('1');
        $fields[] = $sendAnswer;

        //Тема ответа
        $answerSubject = new Field();
        $answerSubject->setName('answer_subject')
                      ->setTitle('forms_answer_subject')
                      ->setType('text')
                      ->setClass('input-xlarge')
                      ->setDefault('');
        $fields[] = $answerSubject;

        //Текст ответа
        $answerText = new Field();
        $answerText->setName('answer_text')
                   ->setTitle('forms_answer_text')
                   ->setType('editor')
                   ->setDefault('')
                   ->setHeight(300);
        $fields[] = $answerText;

        return $fields;
    }

    /**
     * Возвращает поля полей
     * @return array
     */
    public static function getFieldFields(){

        $fields = array();

        //Название
        $name = new Field();
        $name->setName('name')
             ->setTitle('forms_field_name')
             ->setType('text')
             ->setClass('input-xlarge')
             ->setDefault('')
             ->setRequired(true)
             ->setValidation('latin');
        $fields[] = $name;

        //Заголовок
        $title = new Field();
        $title->setName('title')
              ->setTitle('forms_title')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        //Описание
        $description = new Field();
        $description->setName('description')
                    ->setTitle('forms_field_description')
                    ->setType('textarea')
                    ->setDefault('');
        $fields[] = $description;

        //Тип поля
        $type = new Field();
        $type->setName('type')
             ->setTitle('forms_field_type')
             ->setType('select')
             ->setDefault('')
             ->setRequired(true)
             ->setOptions(array(
                0 => array(
                    'id' => 'text',
                    'title' => 'forms_type_text'
                ),
                1 => array(
                    'id' => 'textarea',
                    'title' => 'forms_type_textarea'
                ),
                2 => array(
                    'id' => 'captcha',
                    'title' => 'Captcha'
                )));
        $fields[] = $type;

        //Валидация
        $validation = new Field();
        $validation->setName('validation')
                   ->setTitle('forms_field_validation')
                   ->setType('select')
                   ->setDefault('')
                   ->setOptions(array(

                0 => array(
                    'id' => 'latin',
                    'title' => 'forms_latin'
                ),
                1 => array(
                    'id' => 'email',
                    'title' => 'E-mail'
                ),
                2 => array(
                    'id' => 'captcha',
                    'title' => 'Captcha'
                )
            ));
        $fields[] = $validation;

        //Текст ошибки
        $errorText = new Field();
        $errorText->setName('error_text')
                  ->setTitle('forms_field_error_text')
                  ->setType('textarea')
                  ->setDefault('');
        $fields[] = $errorText;

        //CSS Класс
        $class = new Field();
        $class->setName('class')
              ->setTitle('forms_field_class')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setValidation('latin');
        $fields[] = $class;

        //Обязательный
        $required = new Field();
        $required->setName('required')
                 ->setTitle('forms_field_required')
                 ->setType('checkbox')
                 ->setDefault('');
        $fields[] = $required;

        //По умолчанию
        $default = new Field();
        $default->setName('default')
                ->setTitle('forms_default')
                ->setType('text')
                ->setClass('input-xlarge')
                ->setDefault('');
        $fields[] = $default;

        return $fields;
    }
}