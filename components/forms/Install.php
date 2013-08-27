<?php
/**
 * Установщик
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 17.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsInstall extends Install {

    /** @var string Тип компонент */
    protected $type = 'component';

    /** @var string Название компонента */
    protected $name = 'Forms';

    /** @var array Параметры раздела */
    protected $params = array(
        0 => array(
            'name' => 'form_id',
            'title' => 'forms_form',
            'type' => 'form',
            'default' => ''
        )
    );

    /** @var string Заголовок */
    protected $title = 'forms_forms';

    /**
     * Запуск установки
     * @return bool
     */
    public function execute(){

        $installation = Installation::create();
        $installation->executeSQL(ABS_PATH.'components/forms/install/install.sql');
        $installation->setupAdminComponent($this->name, $this->title);
        return true;
    }
}