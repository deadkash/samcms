<?php
/**
 * Модель
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 08.06.13
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
     * Возвращает поля формы
     * @param $formId
     * @return array|bool
     */
    public function getFieldsByFormId($formId) {

        $formId = (int) $formId;
        $query = "SELECT `id`,
                         `name`,
                         `title`,
                         `description`,
                         `type`,
                         `validation`,
                         `error_text`,
                         `class`,
                         `required`,
                         `default`,
                         `form_id`,
                         `ordering`
                    FROM `forms_fields`
                   WHERE `form_id`=".$formId."
                ORDER BY `ordering`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
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