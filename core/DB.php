<?php

/**
 * Класс для работы с базой данных
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 28.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class DB {

    /**
     * Объект mysqli
     * @var mysqli
     */
    private $mysql;

    /**
     * Запрос
     * @var string
     */
    private $query;

    /**
     * Последний вставленный id
     * @var int
     */
    private $insertId;

    /**
     * SELECT часть запроса
     * @var string
     */
    public $select;

    /**
     * FROM часть запроса
     * @var
     */
    public $from;

    /**
     * WHERE часть запроса
     * @var string
     */
    public $where;

    /**
     * LIMIT часть запроса
     * @var string
     */
    public $limit;

    /**
     * ORDER BY часть запроса
     * @var string
     */
    public $order;

    /**
     * Экземпляр класса
     * @var DB
     */
    private static $db;

    /**
     * Создание экземпляра класса
     * @return DB
     */
    public static function create() {

        if (!self::$db instanceof self) {
            self::$db = new self();
        }
        return self::$db;
    }

    /**
     * Клонирование объекта
     */
    private function __clone() {}

    /**
     * Конструктор
     */
    private function __construct() {

        if (class_exists('Config')) {
            $this->mysql = new mysqli(Config::$dbhost, Config::$dbuser, Config::$dbpass, Config::$dbname);
            $query = "SET NAMES utf8";
            $this->mysql->query($query);
        }

        //Режим отладки
        $this->debug = false;

        //Запрос и его части
        $this->query = '';
        $this->select = '';
        $this->where = '';
        $this->limit = '';
        $this->order = '';

        //ID строки
        $this->insertId = false;
    }

    /**
     * Деструктор
     */
    public function __destruct() {
        $this->mysql->close();
    }

    /**
     * Установить текущий запрос
     * @param $query
     */
    public function setQuery($query = '') {

        //Если запрос пустой, то собираем из частей
        if (!empty($query)) {
            $this->query = $query;
        }
        else {
            $this->query = $this->select.$this->from.$this->where.$this->order.$this->limit.';';
        }
    }

    /**
     * Возвращает текущий запрос
     * @return string
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * Очищает поля запроса
     * @return void
     */
    private function clear() {

        $this->query = '';
        $this->select = '';
        $this->from = '';
        $this->limit = '';
        $this->order = '';
        $this->where = '';
    }

    /**
     * Выполняет запрос
     *
     * @param $query
     * @return mixed
     */
    public function query($query = '') {

        //Если задан запрос, который надо выполнить
        if ($query) {
            $this->query = $query;
        }

        //Если запрос пуст, то выходим
        if (!$this->query) return false;
        $result = $this->mysql->query($this->query);

        //Сохраняем вставленный, id если такой был
        if ($this->mysql->insert_id) {
            $this->insertId = $this->mysql->insert_id;
        }

        //Если включен режим отдадки
        if ($this->debug) {
            Debug::$queries[] = $this->query;
            if ($this->mysql->error) {
                Debug::$mysqlErrors[] = $this->mysql->error.' IN '.$this->query;
            }
        }

        //Чистим запрос
        $this->clear();

        if (!$result) return false;
        else return $result;
    }

    /**
     * Возвращает объект запроса
     * @return bool|stdClass
     */
    public function getObject() {

        $result = $this->query();

        if ($result) {

            $data = $result->fetch_assoc();
            if (!$data) return false;

            $output = new stdClass();
            foreach ($data as $key => $value) {
                $output->$key = $value;
            }
            return $output;
        }
        else return false;
    }

    /**
     * Возвращает массив объектов запроса
     * @return array|bool
     */
    public function getObjectList() {

        $result = $this->query();

        $output = array();
        if ($result) {

            while ($row = $result->fetch_assoc()) {

                $temp = new stdClass();

                foreach ($row as $key => $value) {
                    $temp->$key = $value;
                }
                $output[] = $temp;
            }
            return $output;
        }
        else return $output;
    }

    /**
     * Возращает строку после real_escape
     *
     * @param $value
     * @return string
     */
    public function escape($value) {
        return $this->mysql->real_escape_string($value);
    }

    /**
     * Производит вставку нового элемента
     *
     * @param $table
     * @param $item
     * @return bool
     */
    public function insert($table, $item) {

        $names = '';
        $values = '';
        foreach ($item as $name => $value) {
            $names .= '`'.$name.'`,';
            $values .= "'".$this->escape($value)."',";
        }

        //Отрезаем последний разделитель
        $names = substr($names, 0, strlen($names) - 1);
        $values = substr($values, 0, strlen($values) - 1);

        if (empty($names) || empty($values)) return false;

        $table = $this->escape($table);
        $query = "INSERT INTO `".$table."` (".$names.") VALUES (".$values.");";
        $this->query($query);
        return $this->mysql->insert_id;
    }

    /**
     * Сохраняет запись в базу
     *
     * @param $table название таблицы
     * @param $item запись stdClass
     * @param $key ключ, который идет в where
     * @return bool
     */
    public function save($table, $item, $key) {

        $set = '';
        foreach ($item as $name => $value) {
            if ($name != $key) {
                $set .= "`".$name."`='".$this->escape($value)."',";
            }
        }

        //Отрезаем последний разделитель
        $set = substr($set, 0, strlen($set) - 1);

        if (empty($set)) return false;

        $query = "UPDATE `".$table."`
                     SET ".$set."
                   WHERE `".$key."`='".$item->$key."';";
        return $this->query($query);
    }

    /**
     * Удаляет запись из таблицы
     *
     * @param $table таблица
     * @param $key ключ, по которому происходит удаление
     * @param $value string|array значение ключа
     * @param $mode режим
     * @return bool
     */
    public function delete($table, $key, $value, $mode = false) {

        $table = $this->escape($table);
        $key = $this->escape($key);

        switch ($mode) {

            case 'list':

                foreach ($value as &$val) {
                    $val = "'".$this->escape($val)."'";
                }
                $value = implode(',', $value);
                $query = "DELETE FROM `".$table."` WHERE `".$key."` IN (".$value.");";
                break;

            default:

                $value = $this->escape($value);
                $query = "DELETE FROM `".$table."` WHERE `".$key."`='".$value."';";
                break;
        }

        return $this->query($query);
    }

    /**
     * Возвращает id вставленной записи
     * @return mixed
     */
    public function getInsertId() {
        return $this->insertId;
    }

    /**
     * Возвращает ошибку mysql
     * @return string
     */
    public function getMysqlError() {
        return $this->mysql->error;
    }
}
