<?php
/**
 * Контроллер форм
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsControllerForms extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Form';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Запуск контроллера
     * @return mixed|void
     */
    public function execute() {

        //Загружаем модель
        $this->setModel('Form');

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'send':
                $this->send();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        return $view->display();
    }

    /**
     * Отправка формы
     * @return void
     */
    private function send() {

        //Форма
        $formId = Request::getInt('form_id');
        $form = $this->model->getFormById($formId);
        $fields = $this->model->getFieldsByFormId($formId);
        foreach ($fields as &$field) {
            $field->value = Request::getStr($field->name);
        }

        //Если форма валидна
        $valid = Fields::validate($fields);
        if ($valid) {

            //Отправляем письмо администратору, если нужно
            if ($form->send_admin_email) {
                $this->sendAdminEmail($fields, $form);
            }

            //Отправляем письмо пользователю, если нужно
            if ($form->send_answer) {

                $userEmail = $this->findEmail($fields);
                if ($userEmail) $this->sendUserEmail($userEmail, $form);
            }

            //Редирект на страницу успешной отправки
            $redirectUrl = $this->router->getUrl(array(
                'id'=>$this->itemId,'view'=>'success'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            Fields::setErrors($fields);
        }
    }

    /**
     * Отправляет письмо админу
     * @param $fields
     * @param $form
     */
    private function sendAdminEmail($fields, $form) {

        //Убираем каптчу
        foreach ($fields as $key => $field) {
            if ($field->validation == 'captcha') unset($fields[$key]);
        }

        //Тело письма
        $letterView = $this->getView('adminletter');
        $body = $letterView->display($fields);

        //Тема письма
        $subject = $form->title;

        //Адреса
        $mailTo = $form->admin_email;
        $mailFrom = NOREPLY_EMAIL;

        //Отправляем письмо
        Mailer::sendMail($mailTo, $mailFrom, $subject, $body);
    }

    /**
     * Отправляет письмо пользователю
     * @param $userEmail
     * @param $form
     */
    private function sendUserEmail($userEmail, $form) {
        Mailer::sendMail($userEmail, NOREPLY_EMAIL, $form->answer_subject, $form->answer_text);
    }

    /**
     * Ищет среди полей поле c e-mail
     * @param $fields
     * @return bool
     */
    private function findEmail($fields) {

        foreach ($fields as $field) {
            if ($field->validation == 'email') return $field->value;
        }

        return false;
    }
}