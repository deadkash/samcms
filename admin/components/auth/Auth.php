<?php

/**
 * Модуль авторизации, регистрации и восстановления пароля
 *
 * @project SamCMS
 * @author Kash
 * @package Auth
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Auth extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Login';

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Auth';

    /**
     * Получает представление из параметров раздела
     * @return mixed
     */
    private function getView() {

        if (!$this->itemId) return $this->defaultController;
        $params = Parameters::getComponentParameters($this->name, $this->itemId);
        if (isset($params['view'])) return $params['view'];

        return $this->defaultController;
    }

    /**
     * Метод возвращает html код
     * @return string
     */
    public function render() {

        $this->setSEOParams();
        $action = Request::getStr('action', $this->getView());

        /** @var $controller Controller */
        $controller = $this->getController($action);
        return $controller->execute();
    }
}