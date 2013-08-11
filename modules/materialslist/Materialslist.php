<?php

/**
 * Материалы категории
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 26.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Materialslist extends Module {

    /**
     * Название модуля
     * @var string
     */
    public $name = 'Materialslist';

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'materialslist/templates/';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Класс бд
     * @var DB
     */
    private $db;

    /**
     * Конструктор
     */
    public function __construct() {
        $this->router = Router::create();
        $this->db = DB::create();
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        //Получаем параметры
        $parameters = Parameters::getModuleParametersByLabel($this->label, $this->name, $this->itemId);

        //Загружаем шаблон
        $template = (isset($parameters['template'])) ? $parameters['template'] : false;
        if (!$template) return '';
        $this->tplPath .= $template;

        //Заголовок
        $title = (isset($parameters['title'])) ? $parameters['title'] : false;
        $this->data['title'] = $title;

        //Категория материалов и количество
        $categoryId = (isset($parameters['category_id'])) ?  $parameters['category_id'] : false;
        $count = (isset($parameters['count'])) ? (int) $parameters['count'] : false;
        if (!$count) $count = 3;

        //Получаем материалы
        $materials = $this->getMaterials($categoryId, $count);
        $itemId = $this->getCategorySection($categoryId);
        if ($itemId) {
            foreach ($materials as &$material) {
                $material->href = $this->router->getUrl(array(
                    'id' => $itemId,
                    'material_id' => $material->id
                ));
                $material->date = DatetimeHelper::prepareDate($material->date);
            }
        }
        $this->data['materials'] = $materials;

        return parent::render();
    }

    /**
     * Возвращает раздел с материалами категории
     * @param $categoryId
     * @return bool
     */
    private function getCategorySection($categoryId) {

        $categoryId = (int) $categoryId;
        $query = "SELECT `item_id`
                    FROM `components_parameters`
                   WHERE `component`='materials' AND `name`='category_id' AND `value`=".$categoryId."
                   LIMIT 1;";
        $this->db->setQuery($query);
        $item = $this->db->getObject();

        if (isset($item->item_id)) return $item->item_id;
        else return false;
    }

    /**
     * Возвращает материалы
     * @param $categoryId
     * @param $count
     * @return array|bool
     */
    private function getMaterials($categoryId, $count) {

        $db = DB::create();
        $categoryId = (int) $categoryId;
        $count = (int) $count;

        $query = "SELECT `m`.`id`,
                         `m`.`title`,
                         `m`.`category_id`,
                         `m`.`date`,
                         `m`.`preview`,
                         `mc`.`title` AS `category_title`
                    FROM `materials` AS `m`
               LEFT JOIN `materials_categories` AS `mc`
                      ON (`m`.`category_id`=`mc`.`id`)
                   WHERE `m`.`category_id`=".$categoryId."
                ORDER BY `m`.`date` DESC
                   LIMIT ".$count.";";
        $db->setQuery($query);

        return $db->getObjectList();
    }
}