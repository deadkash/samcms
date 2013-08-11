<?php
/**
 * Модель групп пользователей
 *
 * @project SamCMS
 * @package 
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersModelGroup extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает список групп
     * @return array|bool
     */
    public function getGroups() {

        $query = "SELECT `id`, `name`
                    FROM `users_policy`
                ORDER BY `id`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Добавляет группу
     * @param $group
     */
    public function addGroup($group) {
        $this->db->insert('users_policy', $group);
    }

    /**
     * Обновляет группу
     * @param $group
     */
    public function updGroup($group){
        $this->db->save('users_policy', $group, 'id');
    }

    /**
     * Удаляет группы
     * @param $groups
     * @return bool
     */
    public function deleteGroups($groups) {

        $this->db->delete('users_policy_allow', 'policy_id', $groups, 'list');
        $this->db->delete('users_policy_deny', 'policy_id', $groups, 'list');

        return $this->db->delete('users_policy', 'id', $groups, 'list');
    }

    /**
     * Возвращает группу по id
     * @param $groupId
     * @return bool|stdClass
     */
    public function getGroupById($groupId) {

        $groupId = (int) $groupId;
        $query = "SELECT `id`,
                         `name`
                    FROM `users_policy`
                   WHERE `id`=".$groupId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Возвращает разделы сайта с политиками
     * @param $policyId
     * @return array|bool
     */
    public function getMenus($policyId) {

        $query = "SELECT `mi`.`title`,
                         `mi`.`id`,
                         `mi`.`menu_id`,
                         `m`.`title` AS `menu_title`,
                         `upa`.`id` AS `allow_id`,
                         `upd`.`id` AS `deny_id`
                    FROM `menu_items` AS `mi`
               LEFT JOIN `menu` AS `m`
                      ON `mi`.`menu_id`=`m`.`id`
               LEFT JOIN `users_policy_allow` AS `upa`
                      ON `upa`.`section_id`=`mi`.`id` AND `upa`.`policy_id`=".$policyId."
               LEFT JOIN `users_policy_deny` AS `upd`
                      ON `upd`.`section_id`=`mi`.`id` AND `upd`.`policy_id`=".$policyId."
                   WHERE `mi`.`hide`=0
                ORDER BY `mi`.`level`,`mi`.`ordering`;";
        $this->db->setQuery($query);
        $items = $this->db->getObjectList();
        $output = array();
        foreach ($items as $item) {
            $output[$item->menu_id]['title'] = $item->menu_title;
            $output[$item->menu_id]['items'][] = $item;
        }

        return $output;
    }

    /**
     * Сброс политик
     * @param $policyId
     */
    private function resetPolicies($policyId) {

        $policyId = (int) $policyId;
        $query = "DELETE FROM `users_policy_allow`
                   WHERE `policy_id`=".$policyId." AND `section_id` NOT IN (
                  SELECT `id` FROM `menu_items` WHERE `hide`=1);";
        $this->db->query($query);

        $query = "DELETE FROM `users_policy_deny`
                   WHERE `policy_id`=".$policyId." AND `section_id` NOT IN (
                  SELECT `id` FROM `menu_items` WHERE `hide`=1);";
        $this->db->query($query);
    }

    /**
     * Обновление политик
     * @param $policyId
     * @param $allows
     * @param $denies
     * @return bool
     */
    public function updPolicies($policyId, $allows, $denies){

        if (!$policyId) return false;
        $this->resetPolicies($policyId);

        if ($allows) {
            foreach ($allows as $itemId) {

                if (!$itemId) continue;
                $allow = new stdClass();
                $allow->policy_id = $policyId;
                $allow->section_id = $itemId;
                $this->db->insert('users_policy_allow', $allow);
            }
        }

        if ($denies) {
            foreach ($denies as $itemId) {

                if (!$itemId) continue;
                $deny = new stdClass();
                $deny->policy_id = $policyId;
                $deny->section_id = $itemId;
                $this->db->insert('users_policy_deny', $deny);
            }
        }

        return true;
    }
}