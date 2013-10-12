<?php

/**
 * Модель меню
 *
 * @project SamCMS
 * @package MenuEditor
 * @author Kash
 * @date 6.02.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorModelMenu extends Model {

    /**
     * Таблица меню
     * @const string
     */
    const MENU_TABLE = 'menu';

    /**
     * Таблица пунктов меню
     * @const string
     */
    const ITEMS_TABLE = 'menu_items';

    /**
     * Пункт меню
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает список меню
     * @return array|bool
     */
    public function getMenuList() {

        $query = "SELECT `id`,`title`
                    FROM `".$this::MENU_TABLE."`
                   WHERE `hide`=0
                ORDER BY `id`;";

        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Добавляет новое меню
     *
     * @param $menu stdClass
     * @return bool
     */
    public function saveItem($menu) {

        if (!empty($menu->id)) {
            return $this->db->save($this::MENU_TABLE, $menu, 'id');
        }
        else return $this->db->insert($this::MENU_TABLE, $menu);
    }

    /**
     * Удаляет меню
     *
     * @param $items
     * @return bool
     */
    public function deleteItems($items) {

        //Удаляем пункты меню
        foreach ($items as $item) {

            $query = "SELECT `id`
                        FROM `".$this::ITEMS_TABLE."`
                       WHERE `menu_id`=".$item.";";
            $this->db->setQuery($query);
            $menuItemsStd = $this->db->getObjectList();

            $menuItems = array();
            foreach ($menuItemsStd as $menuItem) {
                $menuItems[] = $menuItem->id;
            }

            $this->deleteComponentParameters($menuItems);
            $this->deleteSectionParameters($menuItems);
            $this->deleteSectionModules($items);
            $this->deleteSearchIndex($menuItems);

            $this->db->delete($this::ITEMS_TABLE, 'id', $menuItems, 'list');
        }

        return $this->db->delete($this::MENU_TABLE, 'id', $items, 'list');
    }

    /**
     * Удаляет пункты меню
     *
     * @param $items
     * @return bool
     */
    public function deleteMenuItems($items) {

        //Удаляем параметры модуля в разделе
        $this->deleteComponentParameters($items);

        //Удаляет параметр раздела
        $this->deleteSectionParameters($items);

        //Удаляет модули раздела
        $this->deleteSectionModules($items);

        //Удаляет поисковый индекс
        $this->deleteSearchIndex($items);

        return $this->db->delete($this::ITEMS_TABLE, 'id', $items, 'list');
    }

    /**
     * Удаляет параметры модулей разделов
     *
     * @param $items
     * @return bool
     */
    public function deleteComponentParameters($items) {
        return $this->db->delete('components_parameters', 'item_id', $items, 'list');
    }

    /**
     * Удаляет поисковый индекс
     * @param $items
     */
    public function deleteSearchIndex($items) {

        foreach ($items as $itemId) {

            $itemId = (int) $itemId;
            $item = Parameters::getItemParameters($itemId);
            $component = $this->db->escape($item->component);

            $query = "DELETE FROM `search`
                            WHERE `element_id`=".$itemId." AND `type`='".$component."';";
            $this->db->query($query);
        }
    }

    /**
     * Удаляет параметры раздела
     *
     * @param $items
     * @return bool
     */
    public function deleteSectionParameters($items) {
        return $this->db->delete('section_parameters', 'section_id', $items, 'list');
    }

    /**
     * Удаляет модули раздела
     *
     * @param $items
     * @return bool
     */
    public function deleteSectionModules($items) {
        return $this->db->delete('section_modules', 'item_id', $items, 'list');
    }

    /**
     * Возвращает меню по id
     *
     * @param $menuId
     * @return bool|stdClass
     */
    public function getMenuById($menuId) {

        $menuId = (int) $menuId;
        $query = "SELECT `id`,`title`
                    FROM `".$this::MENU_TABLE."`
                   WHERE `id`=".$menuId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Возвращает пункты меню по его id
     *
     * @param $menuId
     * @param $parentId
     * @param $itemId
     * @return array|bool
     */
    public function getItemsByMenuId($menuId, $parentId, $itemId = false) {

        $menuId = (int) $menuId;
        $parentId = (int) $parentId;
        $itemId = (int) $itemId;

        $query = "SELECT `m1`.`id`,
                         `m1`.`menu_id`,
                         `m1`.`title`,
                         `m1`.`component`,
                         `m1`.`alias`,
                         `m1`.`active`,
                         `m1`.`visible`,
                         `m1`.`parent`,
                         `m1`.`ordering`,
                         `m1`.`level`,
                         `m1`.`link`,
                         `m2`.`title` AS `parent_title`,
                         `c`.`title` AS `component_title`
                    FROM `".$this::ITEMS_TABLE."` AS `m1`
               LEFT JOIN `".$this::ITEMS_TABLE."` AS `m2`
                      ON `m1`.`parent`=`m2`.`id`
               LEFT JOIN `extensions` AS `c`
                      ON `m1`.`component`=`c`.`name`
                   WHERE `m1`.`menu_id`=".$menuId." AND `m1`.`parent`=".$parentId." AND `m1`.`id`!=".$itemId."
                ORDER BY `m1`.`ordering`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает разделы рекурсивно
     *
     * @param $menuId
     * @param $parentId
     * @param $itemId
     * @return array
     */
    public function getItems($menuId, $parentId, $itemId = false) {

        $output = array();
        $items = $this->getItemsByMenuId($menuId, $parentId, $itemId);
        foreach ($items as &$item) {
            $output[] = $item;
            $subitems = $this->getItems($menuId, $item->id, $itemId);
            if ($subitems) {
                $output = array_merge($output, $subitems);
            }
        }

        return $output;
    }

    /**
     * Возвращает типы пунктов меню
     * @return array|bool
     */
    public function getItemTypes() {

        $query = "SELECT `name`,
                         `title`,
                         `params`
                    FROM `extensions`
                   WHERE `type`='component';";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает данные модуля по названию
     * @param $type
     * @return bool|stdClass
     */
    public function getComponentByType($type) {

        $type = $this->db->escape($type);
        $query = "SELECT `name`,
                         `title`,
                         `params`
                    FROM `extensions`
                   WHERE `name`='".$type."';";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Добавляет новый пункт меню
     * @param $menuItem
     * @return bool
     */
    public function saveMenuItem($menuItem) {

        $menuItem = $this->levelUpItem($menuItem);
        $menuItem->modified = date('Y-m-d H:i:s');

        return $this->db->insert($this::ITEMS_TABLE, $menuItem);
    }

    /**
     * Обновляет пункт меню
     * @param $menuItem
     * @return bool
     */
    public function updMenuItem($menuItem) {

        $menuItem = $this->levelUpItem($menuItem);
        $menuItem->modified = date('Y-m-d H:i:s');

        return $this->db->save($this::ITEMS_TABLE, $menuItem, 'id');
    }

    /**
     * Изменяем уровень элемента в соответствии с уровнем родителя
     * @param $menuItem
     * @return mixed
     */
    private function levelUpItem($menuItem) {

        //Если есть родитель, то повышаем уровень
        if ($menuItem->parent) {
            $parent = $this->getMenuItemById($menuItem->parent);
            $menuItem->level = $parent->level + 1;
        }
        else $menuItem->level = 0;

        return $menuItem;
    }

    /**
     * Проверка существования псевдонима
     * @param $alias
     * @param $itemId
     * @return bool
     */
    public function issetAlias($alias, $itemId = false) {

        $itemId = (int) $itemId;
        $alias = $this->db->escape($alias);

        $query = "SELECT `id`
                    FROM `".$this::ITEMS_TABLE."`
                   WHERE `alias`='".$alias."'";

        if (!empty($itemId)) {
            $query .= " AND `id`!=".$itemId;
        }

        $query .= ";";
        $this->db->setQuery($query);

        if ($this->db->getObjectList()) return true;
        else return false;
    }

    /**
     * Проверка на совпадения псевдонима с системными папками
     * @param $alias
     * @return bool
     */
    public function isSystemAlias($alias) {

        $systemDirs = scandir(ABS_PATH);
        if (in_array($alias, $systemDirs)) return true;
        else return false;
    }

    /**
     * Возвращает пункт меню по id
     * @param $menuItemId
     * @return bool|stdClass
     */
    public function getMenuItemById($menuItemId) {

        $menuItemId = (int) $menuItemId;
        $query = "SELECT `m`.`id`,
                         `m`.`menu_id`,
                         `m`.`title`,
                         `m`.`component`,
                         `m`.`alias`,
                         `m`.`active`,
                         `m`.`visible`,
                         `m`.`parent`,
                         `m`.`ordering`,
                         `m`.`level`,
                         `m`.`link`,
                         `c`.`title` AS `component_title`
                    FROM `".$this::ITEMS_TABLE."` AS `m`
               LEFT JOIN `extensions` AS `c`
                      ON `m`.`component`=`c`.`name`
                   WHERE `id`=".$menuItemId.";";
        $this->db->setQuery($query);
        return $this->db->getObject();
    }

    /**
     *
     * @param $menuItem
     * @return bool
     */
    public function validateMainParameters($menuItem) {

        $valid = true;

        //Если пустой заголовок
        if (empty($menuItem->title)) {
            $valid = false;
            Messages::addMessage('items_empty_title', 'alert-danger', Language::translate('menueditor_msg_empty_title'));
        }

        //Если псевдним пустой, берем заголовок
        if (empty($menuItem->alias)) {
            $menuItem->alias = $menuItem->title;
        }

        //Обрезаем псевдоним
        $menuItem->alias = Translate::translit($menuItem->alias);
        $menuItem->alias = Translate::convert($menuItem->alias);
        Request::setPost('alias', $menuItem->alias);

        //Если псевдоним не пустой и существует
        if (!empty($menuItem->alias) && $this->issetAlias($menuItem->alias, $menuItem->id)) {
            $valid = false;
            Messages::addMessage('items_alias_exists', 'alert-danger', Language::translate('menueditor_msg_alias_exists'));
        }

        //Если псевдоним совпадает с папкой или файлом
        if ($this->isSystemAlias($menuItem->alias)) {
            $valid = false;
            Messages::addMessage('items_alias_system', 'alert-danger', Language::translate('menueditor_msg_system_alias'));
        }

        //Если пустое меню
        if (empty($menuItem->menu_id)) {
            $valid = false;
            Messages::addMessage('items_empty_menu', 'alert-danger', Language::translate('menueditor_msg_empty_menu'));
        }

        return $valid;
    }

    /**
     * Возвращает объект плагина поискового индекса
     * @param $name
     * @return mixed
     */
    private function getSearchPlugin($name) {

        $pluginPath = PLUGINS_PATH.'search/'.$name.'.php';
        $pluginClass = 'Search'.$name;
        if (file_exists($pluginPath)) {
            require_once($pluginPath);

            if (class_exists($pluginClass)) {
                return new $pluginClass();
            }
        }

        return false;
    }

    /**
     * Обновляет поисковый индекс компонента
     * @param $data
     * @param $itemId
     * @param $component
     */
    private function updateSearchIndex($data, $itemId, $component) {

        $plugin = $this->getSearchPlugin($component);
        if ($plugin && method_exists($plugin, 'updateItem')) {
            $plugin->updateItem($data, $itemId);
        }
    }

    /**
     * Сохраняет параметры модуля
     *
     * @param $componentParameters
     * @param $itemId
     * @param $component
     * @return void
     */
    public function saveComponentParameters($componentParameters, $itemId, $component) {

        //Обновляем поисковый индекс
        $this->updateSearchIndex($componentParameters, $itemId, $component);

        if (!empty($componentParameters)) {
            foreach ($componentParameters as $parameter) {

                unset($parameter->default);
                $parameter->component = $component;
                $parameter->item_id = $itemId;

                $this->db->insert('components_parameters', $parameter);
            }
        }
    }

    /**
     * Сохраняет параметры раздела
     *
     * @param $sectionParameters
     * @param $itemId
     */
    public function saveSectionParameters($sectionParameters, $itemId) {

        foreach($sectionParameters as $parameter) {

            $param = new stdClass();
            $param->name = $parameter->name;
            $param->title = $parameter->title;
            $param->type = $parameter->type;
            $param->value = $parameter->value;

            $param->section_id = $itemId;
            $this->db->insert('section_parameters', $param);
        }
    }

    /**
     * Сохраняет модули раздела
     *
     * @param $sectionModules
     * @param $menuItemId
     */
    public function saveSectionModules($sectionModules, $menuItemId) {

        if (!empty($sectionModules)) {
            foreach($sectionModules as $moduleId) {

                $module = new stdClass();
                $module->item_id = $menuItemId;
                $module->module_id = $moduleId;

                $this->db->insert('section_modules', $module);
            }
        }
    }

    /**
     * Обновляет параметры модуля
     *
     * @param $componentParameters
     * @param $itemId
     * @param $component
     */
    public function updComponentParameters($componentParameters, $itemId, $component) {

        //Обновляем поисковый индекс
        $this->updateSearchIndex($componentParameters, $itemId, $component);

        foreach ($componentParameters as $parameter) {

            $parameter->value = $this->db->escape($parameter->value);
            $parameter->name = $this->db->escape($parameter->name);

            $query = "UPDATE `components_parameters`
                         SET `value`='".$parameter->value."'
                       WHERE `name`='".$parameter->name."' AND `item_id`=".$itemId.";";
            $this->db->query($query);
        }
    }

    /**
     * Обновляет параметры раздела
     *
     * @param $sectionParameters
     * @param $itemId
     */
    public function updSectionParameters($sectionParameters, $itemId) {

        foreach ($sectionParameters as $parameter) {

            $parameter->value = $this->db->escape($parameter->value);
            $parameter->name = $this->db->escape($parameter->name);

            $query = "UPDATE `section_parameters`
                         SET `value`='".$parameter->value."'
                       WHERE `name`='".$parameter->name."' AND `section_id`=".$itemId.";";
            $this->db->query($query);
        }
    }

    /**
     * Удаляет все модули раздела
     * @param $itemId
     */
    public function clearSectionModules($itemId) {

        $itemId = (int) $itemId;
        $this->db->delete('section_modules', 'item_id', $itemId);
    }

    /**
     * Обновляет модули раздела
     *
     * @param $sectionModules
     * @param $itemId
     */
    public function updSectionModules($sectionModules, $itemId) {

        $this->clearSectionModules($itemId);
        $this->saveSectionModules($sectionModules, $itemId);
    }

    /**
     * Возвращает список модулей
     *
     * @param $itemId
     * @return array|bool
     */
    public function getModules($itemId = false) {

        $itemId = (int) $itemId;

        $query = "SELECT `id`,`name`,`title`
                    FROM `modules`
                   WHERE `hide`=0;";

        if ($itemId) {
            $query = "SELECT `m`.`id`,
                             `m`.`name`,
                             `m`.`title`,
                             `sm`.`id` AS `checked`
                        FROM `modules` AS `m`
                   LEFT JOIN `section_modules` AS `sm`
                          ON `sm`.`module_id`=`m`.`id` AND `sm`.`item_id`=".$itemId."
                       WHERE `m`.`hide`=0;";
        }

        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает параметры компонента
     *
     * @param $component
     * @param $itemId
     * @return array|bool
     */
    public function getComponentParameters($component, $itemId) {
        return Parameters::getAllComponentParameters($component, $itemId);
    }

    /**
     * Возвращает первую позицию элемента
     *
     * @param $menuId
     * @param $parent
     * @return mixed
     */
    public function getItemFirstPosition($menuId, $parent = 0) {

        $menuId = (int) $menuId;
        $query = "SELECT MIN(`ordering`) AS `position`
                    FROM `".$this::ITEMS_TABLE."`
                   WHERE `menu_id`=".$menuId." AND `parent`=".$parent.";";
        $this->db->setQuery($query);

        return $this->db->getObject()->position;
    }

    /**
     * Возвращает последнюю позицию элемента
     *
     * @param $menuId
     * @param $parent
     * @return mixed
     */
    public function getItemLastPosition($menuId, $parent = 0) {

        $menuId = (int) $menuId;
        $query = "SELECT MAX(`ordering`) AS `position`
                    FROM `".$this::ITEMS_TABLE."`
                   WHERE `menu_id`=".$menuId." AND `parent`=".$parent.";";
        $this->db->setQuery($query);

        return $this->db->getObject()->position;
    }

    /**
     * Поднимаем элемент наверх
     * @param $itemId
     */
    public function moveUp($itemId) {

        $itemId = (int) $itemId;
        $item = $this->getMenuItemById($itemId);

        //Если еще не первый, то двигаем
        if ($item->ordering != $this->getItemFirstPosition($item->menu_id, $item->parent)) {

            //Находим id предыдущего элемента
            $query = "SELECT `id`,
                             `ordering`,
                             `menu_id`,
                             `parent`
                        FROM `".$this::ITEMS_TABLE."`
                       WHERE `menu_id`=".$item->menu_id." AND `ordering`<".$item->ordering."
                              AND `parent`=".$item->parent."
                    ORDER BY `ordering` DESC
                       LIMIT 1";
            $this->db->setQuery($query);
            $prevItem = $this->db->getObject();

            $newOrdering = $prevItem->ordering;

            //Задаем ему порядок текущего элемента
            $this->updateOrdering($prevItem->id, $item->ordering);

            //А текущему задаем порядок предыдущего
            $this->updateOrdering($itemId, $newOrdering);
        }
    }

    /**
     * Опускает элемент вниз
     * @param $itemId
     */
    public function moveDown($itemId) {

        $itemId = (int) $itemId;
        $item = $this->getMenuItemById($itemId);

        if ($item->ordering != $this->getItemLastPosition($item->menu_id, $item->parent)) {

            //Находим id следующего элемента
            $query = "SELECT `id`,
                             `menu_id`,
                             `ordering`,
                             `parent`
                        FROM `".$this::ITEMS_TABLE."`
                       WHERE `menu_id`=".$item->menu_id." AND `ordering`>".$item->ordering."
                             AND `parent`=".$item->parent."
                    ORDER BY `ordering` ASC
                       LIMIT 1";
            $this->db->setQuery($query);
            $nextItem = $this->db->getObject();

            $newOrdering = $nextItem->ordering;

            //Задаем ему порядок текущего элемента
            $this->updateOrdering($nextItem->id, $item->ordering);

            //А текущему задаем порядок следующего
            $this->updateOrdering($itemId, $newOrdering);
        }
    }

    /**
     * Обновляет порядок
     * @param $itemId
     * @param $ordering
     */
    private function updateOrdering($itemId, $ordering) {

        $query = "UPDATE `".$this::ITEMS_TABLE."`
                         SET `ordering`=".$ordering."
                       WHERE `id`=".$itemId.";";
        $this->db->query($query);
    }

    /**
     * Подготавливает параметры раздела
     *
     * @param $parameters
     * @param $title
     * @return mixed
     */
    public function prepareSectionParameters($parameters, $title) {

        $seo = Seo::create();
        foreach ($parameters as &$parameter) {

            switch ($parameter->name) {

                case 'title':
                    if (empty($parameter->value)) {
                        $parameter->value = $seo->createTitle($title);
                    }
                    break;

                case 'description':
                    if (empty($parameter->value)) {
                        $parameter->value = $seo->createDescription($title);
                    }
                    break;

                case 'keywords':
                    if (empty($parameter->value)) {
                        $parameter->value = $seo->createKeywords($title);
                    }
                    break;
            }
        }

        return $parameters;
    }
}