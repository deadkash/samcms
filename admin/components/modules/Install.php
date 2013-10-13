<?php

/**
 * Установщик редактора модулей
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 27.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesInstall extends Install {

    /** @var bool Не регистрировать компонент */
    public $registerMe = false;

    /** @var int Порядок в системном меню */
    private $order = 2;

    /** @var string Имя компонента */
    protected $name = 'Modules';

    /** @var string Название компонента */
    protected $title = 'modules';

    /** @var string Тип компонент */
    protected $type = 'component';

    /** @var string Псевдоним */
    protected $alias = 'module';

    /**
     * Запуск установки
     * @return bool
     */
    public function execute(){

        $installation = Installation::create();
        $installation->setupSystemComponent($this->name, $this->title, $this->alias, $this->order);

        return true;
    }
}