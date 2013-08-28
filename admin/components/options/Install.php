<?php

/**
 * Установщик редактора настроек
 *
 * @project SamCMS
 * @package Options
 * @author Kash
 * @date 27.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class OptionsInstall extends Install {

    /** @var bool Не регистрировать компонент */
    public $registerMe = false;

    /** @var int Порядок в системном меню */
    private $order = 4;

    /** @var string Имя компонента */
    protected $name = 'Options';

    /** @var string Название компонента */
    protected $title = 'options_options';

    /** @var string Тип компонент */
    protected $type = 'component';

    /** @var string Псевдоним */
    protected $alias = 'options';

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