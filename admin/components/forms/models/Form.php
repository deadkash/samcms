<?php
/**
 * Модель формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 02.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsModelForm extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавление новой формы
     * @param $form
     * @return bool
     */
    public function addForm($form) {
        return $this->db->insert('forms', $form);
    }

    /**
     * Обновление формы
     * @param $form
     * @return bool
     */
    public function updForm($form) {
        return $this->db->save('forms', $form, 'id');
    }

    /**
     * Возвращает список форм
     * @return array|bool
     */
    public function getForms() {

        $query = "SELECT `id`,
                         `title`,
                         `name`,
                         `success_text`,
                         `send_admin_email`,
                         `admin_email`,
                         `send_answer`,
                         `answer_subject`,
                         `answer_text`
                    FROM `forms`
                ORDER BY `id`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Удаляет формы
     * @param $forms
     * @return bool
     */
    public function deleteForms($forms) {

        $this->db->delete('forms_fields', 'form_id', $forms, 'list');
        return $this->db->delete('forms', 'id', $forms, 'list');
    }

    /**
     * Возвращает форму по id
     * @param $formId
     * @return bool|stdClass
     */
    public function getFormById($formId) {

        $formId = (int) $formId;
        $query = "SELECT `id`,
                         `title`,
                         `name`,
                         `success_text`,
                         `send_admin_email`,
                         `admin_email`,
                         `send_answer`,
                         `answer_subject`,
                         `answer_text`
                    FROM `forms`
                   WHERE `id`=".$formId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }
}