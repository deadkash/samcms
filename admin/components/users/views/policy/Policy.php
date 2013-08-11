<?php
/**
 * Редактирование доступа к разделам
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 01.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersViewPolicy extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка html-кода
     * @return string
     */
    public function display() {

        //Загружаем модель
        $this->setModel('Group');

        //Группа
        $groupId = Request::getInt('group_id');
        $group = $this->model->getGroupByid($groupId);
        $this->setValue('policy_id', $groupId);
        $this->setValue('group', $group);

        //Разделы сайта
        $menus = $this->model->getMenus($groupId);
        if (!empty($menus)) $this->setValue('menus', $menus);

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'groups','view'=>'policy','group_id'=>$groupId));
        $this->setValue('url', $postUrl);

        //Устанавливаем шаблон
        $this->setTemplate('policy.twig');

        return $this->render();
    }
}