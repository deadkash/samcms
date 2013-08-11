<?php
/**
 * Компонент карты сайта
 *
 * @project SamCMS
 * @package Sitemap
 * @author Kash
 * @date 27.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Sitemap extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'sitemap';

    /**
     * Название компонента
     * @var string
     */
    public $name = __CLASS__;

    /**
     * Запуск контроллера
     * @return mixed|string
     */
    public function render() {

        $controller = $this->getController($this->defaultController);

        $this->setSEOParams();
        $this->setLastModifiedDate();
        return $controller->execute();
    }
}