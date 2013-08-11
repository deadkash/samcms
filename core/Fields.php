<?php
/**
 * Поля
 *
 * @project SamCMS
 * @package Core
 * @author Kash
 * @date 06.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Fields extends Core {

    /**
     * Возвращает код редактора
     * @param $param
     * @return mixed
     */
    public static function getField($param) {

        $editor = self::getEditor($param->type);
        if (!$editor) return false;

        return $editor->render($param);
    }

    /**
     * Обработка поля
     * @param $field
     */
    public static function setField(&$field) {

        $field->title = Language::translate($field->title);
        $field->default = Request::getStr($field->name, $field->default);
        $field->value = $field->default;
        $field->html = Fields::getField($field);
        $field->error = Messages::issetError($field->name.'_error');
    }

    /**
     * Возвращает редактор
     * @param $editorName
     * @return mixed
     */
    public static function getEditor($editorName) {

        $editorPath = ABS_PATH.'core/editors/'.$editorName.'/editor.php';
        $editorClassName = $editorName.'Editor';

        if (file_exists($editorPath)) {

            require_once($editorPath);
            return new $editorClassName();
        }
        else return false;
    }

    /**
     * Валидация полей
     * @param $fields
     * @return bool|mixed
     */
    public static function validate(&$fields) {

        if (!$fields) return false;

        $valid = true;
        foreach ($fields as &$field) {
            $fieldValid = self::validateField($field);
            if (!$fieldValid) $valid = false;
        }

        return $valid;
    }

    /**
     * Валидация обязательности
     * @param $field
     * @return bool
     */
    public static function validateRequired(&$field) {

        $valid = true;

        if (isset($field->required)) {

            $required = $field->required;
            if ($required) {

                if (empty($field->value)) {
                    $valid = false;
                    $field->error = 'required';
                }
            }
        }

        return $valid;
    }

    /**
     * Валидация поля
     * @param $field
     * @return bool|mixed
     */
    public static function validateField(&$field) {

        //Обязательное поле
        $valid = self::validateRequired($field);
        if (!$valid) return $valid;

        $fieldValue = $field->value;

        if (empty($fieldValue)) return $valid;

        $validation = false;
        if (isset($field->validation)) $validation = $field->validation;

        $fieldError = false;
        if ($validation) {

            switch ($validation) {

                case 'email':
                    $valid = ValidationHelper::checkEmail($fieldValue);
                    if (!$valid) $fieldError = $validation;
                    break;

                case 'latin':
                    $valid = ValidationHelper::checkLogin($fieldValue);
                    if (!$valid) $fieldError = $validation;
                    break;

                case 'captcha':
                    $valid = Captcha::check($fieldValue);
                    if (!$valid) $fieldError = $validation;
                    break;

                case 'integer':
                    $valid = ValidationHelper::checkInteger($fieldValue);
                    if (!$valid) $fieldError = $validation;
                    break;

                case 'image':

                    if ($fieldValue->error) {
                        $valid = false;
                        $fieldError = 'not_uploaded';
                    }

                    if (isset($field->size)) {
                        if ($fieldValue->size > $field->size) {
                            $valid = false;
                            $fieldError = 'max_size';
                        }
                    }
                    break;
            }
        }

        if ($fieldError) {
            $field->error = $fieldError;
        }

        return $valid;
    }

    /**
     * Вываливает ошибки
     * @param $fields
     * @param $component
     */
    public static function setMessages($fields, $component) {

        foreach ($fields as $field) {

            $fieldError = false;
            if (isset($field->error)) $fieldError = $field->error;
            $fieldName = $field->name;

            if ($fieldError) {
                $messageName = $fieldName.'_error';
                $messageText = Language::translate(strtolower($component).'_msg_'.$fieldName.'_error_'.$fieldError);
                Messages::addMessage($messageName, 'alert-danger', $messageText);
            }
        }
    }

    /**
     * Устанавливает ошибки
     * @param $fields
     */
    public static function setErrors($fields) {

        foreach ($fields as $field) {

            $fieldError = false;
            if (isset($field->error)) $fieldError = $field->error;
            $fieldName = $field->name;

            if ($fieldError) {
                $messageName = $fieldName.'_error';
                Messages::addError($messageName, 'invalid');
            }
        }
    }
}