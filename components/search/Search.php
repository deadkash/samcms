<?php
/**
 * Компонент результатов поиска
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Search extends Component {

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Search';

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Main';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        /** @var $controller Controller */
        $controller = $this->getController($this->defaultController);
        if (!$controller) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        $this->setSEOParams();

        return $controller->execute();
    }
}