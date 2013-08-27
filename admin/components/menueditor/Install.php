<?php

/**
 * Установщик редактора разделов
 *
 * @project SamCMS
 * @package MenuEditor
 * @author Kash
 * @date 27.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorInstall extends Install {

    /** @var bool Не регистрировать компонент */
    public $registerMe = false;

    /** @var int Порядок в системном меню */
    private $order = 1;

    /** @var string Имя компонента */
    protected $name = 'Menueditor';

    /** @var string Название компонента */
    protected $title = 'core_menueditor';

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