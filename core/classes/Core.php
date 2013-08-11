<?php

/**
 * Заготовка для классов ядра
 *
 * @project SamCMS
 * @author Kash
 * @package class
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class Core {

    /**
     * Класс для работы с базой данных
     * @var DB
     */
    public $db;

    /**
     * Конструктор
     */
    public function __construct() {
        $this->db = DB::create();
    }
}
