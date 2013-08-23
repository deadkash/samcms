<?php

/**
 * Модель установщика
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 21.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class BuilderModelMain extends Model {

    public function __construct(){
        
    }

    /**
     * Возвращает языки
     * @return array
     */
    public function getLanguages(){

        return array(
            0 => array(
                'title' => 'Русский',
                'value' => 'ru',
                'selected' => true
            ),
            1 => array(
                'title' => 'English',
                'value' => 'en'
            )
        );
    }
}