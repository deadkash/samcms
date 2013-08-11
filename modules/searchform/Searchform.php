<?php
/**
 * Поле для поиска
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Searchform extends Module {
    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'searchform/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Searchform';

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        $router = Router::create();
        $searchSection = $this->getSearchSection();
        if (!$searchSection) return '';

        $this->data['url'] = $router->getUrl(array('id' => $searchSection));

        return parent::render();
    }

    /**
     * Возвращает раздел с результатами поиска
     * @return bool
     */
    private function getSearchSection() {

        $db = DB::create();
        $query = "SELECT `id`
                    FROM `menu_items`
                   WHERE `component`='search'
                   LIMIT 1;";
        $db->setQuery($query);
        $item = $db->getObject();

        if (isset($item->id)) return $item->id;
        else return false;
    }
}