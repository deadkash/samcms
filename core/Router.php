<?php

/**
 * Роутер приложения
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Router {

    /**
     * Запрашиваемый URL
     * @var string
     */
    private $url;

    /**
     * Адрес сайта
     * @var string
     */
    private $base;

    /**
     * Массив псевдонимов
     * @var array
     */
    private $aliases;

    /**
     * Компоненты
     * @var array
     */
    private $components;

    /**
     * Окончание пути
     * @var string
     */
    public $end;

    /**
     * Экземпляр класса
     * @var Router
     */
    public static $router;

    /**
     * Создание экземпляра класса
     * @return Router
     */
    public static function create() {

        if (!self::$router instanceof self) {
            self::$router = new self();
        }

        return self::$router;
    }

    /**
     * Клонирование
     */
    private function __clone() {}

    /**
     * Конструктор
     */
    private function __construct() {

        $this->url = $_SERVER['REQUEST_URI'];
        $this->base = 'http://'.$_SERVER['HTTP_HOST'];

        if (defined('ADMIN')) $this->base = 'http://'.$_SERVER['HTTP_HOST'].'/admin';
        if (defined('ADMIN')) $this->url = str_replace('/admin', '', $this->url);

        $this->aliases = array();
        $this->components = array();

        $this->end = Parameters::getParameter('end');
        $this->db = DB::create();
    }

    /**
     * Переписывает url в ЧПУ
     *
     * Метод разбирает параметры в URL в массив. Переписывает id пункта меню в его псевдоним. Находит модуль, который
     * закреплен за пунктом меню и пытается найти его роутер, который перепишет остальные параметры. Если этого роутера
     * нет, то вставит оставшиеся параметры как есть.
     *
     * @param $link
     * @return string
     */
    public function rewriteUrl($link) {

        //Если ЧПУ выключен, то отдаем ссылку как есть
        if (!Parameters::$parameters['sef']) return $link;

        //Если псевдонимы еще не получали, то получить
        if (empty($this->aliases)) {
            $this->aliases = $this->getAliases();
        }

        //Разбираем ссылку на переменные
        list($index, $query) = explode('?', $link);
        $queryArray = explode('&', $query);

        //Загоняем в массив
        $values = array();
        foreach ($queryArray as $queryItem) {
            list($name, $value) = explode('=', $queryItem);
            $values[$name] = $value;
        }

        //Если нет переменной пункта меню, то выходим
        if (!isset($values['id'])) return $link;
        $itemId = $values['id'];
        unset($values['id']);

        //Получаем псевдоним раздела
        $alias = $this->getAliasByItemId($itemId);
        if (!$alias) {
            return $link;
        }

        //Собираем оставшийся url
        $queryRewrited = false;
        if (!empty($values)) {

            //Пробуем найти роутер модуля, который перепишет остальные параметры
            $moduleName = $this->getItemComponent($itemId);
            $modulePath = 'components/'.strtolower($moduleName).'/Route.php';
            if (file_exists($modulePath)) {
                require_once($modulePath);
                $moduleClass = $moduleName.'Route';
                /**
                 * @var $moduleClass Route
                 */
                $newQuery = $moduleClass::rewriteParams($values);
                $queryRewrited = true;
            }
            else {
                $newQuery = '?';
                foreach ($values as $name => $value) {
                    $newQuery .= $name.'='.$value.'&';
                }
                $newQuery = substr($newQuery, 0, strlen($newQuery) - 1);
            }

        }
        else $newQuery = '';

        //Если параметры были переписаны
        if ($queryRewrited) $alias = $alias.'/';
        else $alias = $alias.$this->end;

        if ($itemId == Parameters::getParameter('default_section')) {
            $alias = '';
        }

        $link = $this->base.'/'.$alias.$newQuery;

        return $link;
    }

    /**
     * Восстанавливает параметры из url
     *
     * Метод отрезает лишнее от url. Разрезает запрос по слэшам. Первый параметр это псевдоним раздела. Ищет модуль,
     * который закреплен за разделом и его роутер, который восстановит остальные параметры.
     *
     * @return int
     */
    public function recoverUrl() {

        //Главная страница
        $defaultId = Parameters::$parameters['default_section'];
        if (defined('ADMIN')) $defaultId = Parameters::$parameters['default_admin_section'];

        //Если id пришел в get запросе, то отдаем его сразу
        $itemId = Request::getInt('id');
        if ($itemId) return $itemId;

        $url = $this->url;

        //Если раздела в запросе нет и url равен слэшу, то это главная
        if (!$itemId && $url == '/') {
            $itemId = $defaultId;
        }

        //Если ЧПУ выключен, то выходим
        if (!Parameters::$parameters['sef']) return $itemId;

        //Отрезаем запрос
        list($aliasPath) = explode('?', $url);

        //Убираем последний слэш, если есть
        if (strrpos($aliasPath, $this->end) === (strlen($aliasPath) - strlen($this->end))) {
            $aliasPath = substr($aliasPath, 0, strlen($aliasPath)-strlen($this->end));
        }
        else {
            //Если не главная то редиректим
            if ($itemId != $defaultId) {

                //Если на конце не слэш
                if (strrpos($aliasPath, '/') !== (strlen($aliasPath) - 1)) {
                    $this->redirect($this->base.$this->url.$this->end);
                }
            }
        }

        //Убираем первый слеш, если есть
        if (isset($aliasPath[0]) && $aliasPath[0] == '/') {
            $aliasPath = substr($aliasPath, 1);
        }

        //Если путь пустой, значит главная
        if (empty($aliasPath)) {
            $itemId = $defaultId;
        }
        else {

            //Разрезаем параметры по слэшам
            $params = explode('/', $aliasPath);

            //Первый параметр это псевдоним раздела
            $itemId = $this->getItemIdByAlias($params[0]);

            //Если главная
            if ($itemId == $defaultId) {
                $this->redirect('/');
            }

            //Выкдиваем псевдонима раздела
            array_shift($params);

            //Если еще остались параметры для разбора
            if (!empty($params)) {

                //Пытаемся найти роутер модуля, которые восставновит остальные параметры
                $componentName = $this->getItemComponent($itemId);
                $componentRoutePath = 'components/'.strtolower($componentName).'/Route.php';
                if (file_exists($componentRoutePath)) {

                    require_once($componentRoutePath);
                    /** @var $moduleClass Route */
                    $moduleClass = $componentName.'Route';
                    $moduleClass::recoverParams($params);
                }
                //Раздел нашелся, но остались параметры для разбора и разобрать их некому
                else {
					$itemId = false;
				}
            }
        }

        //Если раздел нашелся
        if ($itemId) {
            Request::setGet('id', $itemId);
            $this->headers('200');
        }
        else {
            $this->headers('404');
        }

        return $itemId;
    }

    /**
     * Возвращает компонент раздела
     * @param $itemId
     * @return bool
     */
    private function getItemComponent($itemId) {

        if (isset($this->components[$itemId])) return $this->components[$itemId];
        else {
            $component = ApplicationHelper::getItemComponent($itemId);
            $this->components[$itemId] = $component;
            return $component;
        }
    }

    /**
     * Отправляет заголовки
     *
     * @param $type
     */
    public function headers($type) {

        $document = Document::get();
        switch ($type) {
            case '404':
                $document->setHTTPStatus('HTTP/1.0 404 Not Found');
                break;

            case '200':
                $document->setHTTPStatus('HTTP/1.0 200 Ok');
                break;
        }
    }

    /**
     * Редиректит на указанный адрес
     * С версии 0.2.2 устанавливает заголовоки редиректа на указанный адрес, который будет обработан при генерации
     * документа.
     *
     * @static
     * @param $url
     * @return void
     */
    public static function redirect($url) {

        $document = Document::get();
        $document->setHTTPStatus('HTTP/1.0 302 Found');
        $document->setLocation($url);
        $document->render();
        exit;
    }

    /**
     * Возвращает id пункта меню по псевдониму
     *
     * @param $alias
     * @return bool
     */
    public function getItemIdByAlias($alias) {

        $alias = $this->db->escape($alias);

        $query = "SELECT `id`
                    FROM `menu_items`
                   WHERE `alias`='".$alias."'";
        if (!defined('ADMIN')) $query .= " AND `hide`=0 AND `active`=1";
        else $query .= "AND `hide`=1";
        $query .= ";";

        $this->db->setQuery($query);
        $section = $this->db->getObject();

        if (!$section) return false;
        return $section->id;
    }

    /**
     * Возвращает псевдоним пункта меню
     *
     * @param $itemId
     * @return bool
     */
    public function getAliasByItemId($itemId) {

        if (isset($this->aliases[$itemId])) return $this->aliases[$itemId];
        else return false;
    }

    /**
     * Возвращает массив псевдонимов
     *
     * @return array
     */
    public function getAliases() {

        $query = "SELECT `id`,`alias`
                    FROM `menu_items`;";
        $this->db->setQuery($query);
        $items = $this->db->getObjectList();

        $output = array();
        foreach ($items as $item) {
            $output[$item->id] = $item->alias;
        }
        return  $output;
    }

    /**
     * Собирает ссылку по параметрам
     *
     * @param $params
     * @return string
     */
    public function getUrl($params) {

        $url = $this->base.'/index.php?';

        $first = true;
        foreach ($params as $name => $value) {
            if ($first) {
                $param = $name.'='.$value;
                $first = false;
            }
            else $param = '&'.$name.'='.$value;
            $url .= $param;
        }

        return $this->rewriteUrl($url);
    }
}
