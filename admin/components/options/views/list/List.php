<?php

/**
 * Представление списка параметров
 *
 * @project SamCMS
 * @author Kash
 * @package Options
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class OptionsViewList extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function display() {

        //Загружаем модель
        $this->setModel('Options');

        //Получаем параметры
        $parameters = $this->model->getParameters();
        $groups = array();
        $firstGroup = false;
        if (!empty($parameters)) {

            foreach ($parameters as &$parameter) {

                if (!$firstGroup) $firstGroup = $parameter->group_id;

                $parameter->default = $parameter->value;
                $parameter->html = Fields::getField($parameter);
                $parameter->group_title = Language::translate($parameter->group_title);
                $parameter->title = Language::translate($parameter->title);

                $groups[$parameter->group_id]['id'] = $parameter->group_id;
                $groups[$parameter->group_id]['title'] = $parameter->group_title;
                $groups[$parameter->group_id]['items'][] = $parameter;
            }
        }
        if (isset($groups[$firstGroup])) {
            $groups[$firstGroup]['active'] = true;
        }
        $this->setValue('groups', $groups);
        $this->setValue('url', $this->router->getUrl(array('id' => $this->itemId)));
        $this->setTemplate('list.twig');

        return $this->render();
    }
}