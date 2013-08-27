<?php

/**
 * Установщик редактора пользователей
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 27.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class UsersInstall extends Install {

    /** @var bool Не регистрировать компонент */
    public $registerMe = false;

    /** @var int Порядок в системном меню */
    private $order = 3;

    /** @var string Имя компонента */
    protected $name = 'Users';

    /** @var string Название компонента */
    protected $title = 'core_users';

    /** @var string Тип компонент */
    protected $type = 'component';

    /**
     * Запуск установки
     * @return bool
     */
    public function execute(){

        $installation = Installation::create();
        $installation->setupSystemComponent($this->name, $this->title, $this->order);

        return true;
    }
}