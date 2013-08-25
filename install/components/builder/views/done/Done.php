<?php
/**
 * Представление завершения установки
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 24.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class BuilderViewDone extends View {

    /**
     * Отрисовка
     * @return string
     */
    public function display(){

        $this->setTemplate('done.twig');

        return $this->render();
    }
}