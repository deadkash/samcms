<?php
/**
 * Модель поля формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 07.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsModelField extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавляет поле формы
     * @param $field
     * @return bool
     */
    public function addField($field) {
        return $this->db->insert('forms_fields', $field);
    }

    /**
     * Обновляет поле формы
     * @param $field
     * @return bool
     */
    public function updField($field) {
        return $this->db->save('forms_fields', $field, 'id');
    }

    /**
     * Удаляет поля
     * @param $fields
     * @return bool
     */
    public function deleteFields($fields) {
        return $this->db->delete('forms_fields', 'id', $fields, 'list');
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
     * Возвращает поле по id
     * @param $fieldId
     * @return bool|stdClass
     */
    public function getFieldById($fieldId) {

        $fieldId = (int) $fieldId;
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
                   WHERE `id`=".$fieldId.";";
        $this->db->setQuery($query);
        return $this->db->getObject();
    }

    /**
     * Возвращате максимальную позицию формы
     * @param $formId
     * @return mixed
     */
    public function getLastPosition($formId) {

        $formId = (int) $formId;
        $query = "SELECT MAX(`ordering`) AS `position`
                    FROM `forms_fields`
                   WHERE `form_id`=".$formId.";";
        $this->db->setQuery($query);

        return $this->db->getObject()->position;
    }

    /**
     * Возвращает первую позицию в форме
     * @param $formId
     * @return mixed
     */
    public function getFirstPosition($formId) {

        $formId = (int) $formId;
        $query = "SELECT MIN(`ordering`) AS `position`
                    FROM `forms_fields`
                   WHERE `form_id`=".$formId.";";
        $this->db->setQuery($query);

        return $this->db->getObject()->position;
    }

    /**
     * Поднимаем элемент наверх
     * @param $fieldId
     */
    public function moveUp($fieldId) {

        $fieldId = (int) $fieldId;
        $field = $this->getFieldById($fieldId);

        //Если еще не первый, то двигаем
        if ($field->ordering != $this->getFirstPosition($field->form_id)) {

            //Находим id предыдущего элемента
            $query = "SELECT `id`,
                             `ordering`
                        FROM `forms_fields`
                       WHERE `form_id`=".$field->form_id." AND `ordering`<".$field->ordering."
                    ORDER BY `ordering` DESC
                       LIMIT 1";
            $this->db->setQuery($query);
            $prevItem = $this->db->getObject();

            //Задаем ему порядок текущего элемента
            $query = "UPDATE `forms_fields`
                         SET `ordering`=".$field->ordering."
                       WHERE `id`=".$prevItem->id.";";
            $this->db->query($query);

            //А текущему задаем порядок предыдущего
            $query = "UPDATE `forms_fields`
                         SET `ordering`=".$prevItem->ordering."
                       WHERE `id`=".$fieldId.";";
            $this->db->query($query);
        }
    }

    /**
     * Опускает элемент вниз
     * @param $fieldId
     */
    public function moveDown($fieldId) {

        $fieldId = (int) $fieldId;
        $field = $this->getFieldById($fieldId);

        if ($field->ordering != $this->getLastPosition($field->form_id)) {

            //Находим id следующего элемента
            $query = "SELECT `id`,
                             `ordering`
                        FROM `forms_fields`
                       WHERE `form_id`=".$field->form_id." AND `ordering`>".$field->ordering."
                    ORDER BY `ordering` ASC
                       LIMIT 1";
            $this->db->setQuery($query);
            $nextItem = $this->db->getObject();

            //Задаем ему порядок текущего элемента
            $query = "UPDATE `forms_fields`
                         SET `ordering`=".$field->ordering."
                       WHERE `id`=".$nextItem->id.";";
            $this->db->query($query);

            //А текущему задаем порядок следующего
            $query = "UPDATE `forms_fields`
                         SET `ordering`=".$nextItem->ordering."
                       WHERE `id`=".$fieldId.";";
            $this->db->query($query);
        }
    }
}