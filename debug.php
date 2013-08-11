<?php

/**
 * Отладчик системы
 *
 * @project SamCMS
 * @author Kash
 * @package root
 * @date 29.07.12
 * @source debug.php
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

if (Parameters::$parameters['debug']) {

    echo 'Time: '.(microtime(1) - $startTime).'<br>';
    echo 'Memory: '.(memory_get_peak_usage()).'<br>';

    //Количество запросов
    echo '<br>queries: '.count(Debug::$queries).'<br>';
    echo '<br>';

    //Запросы
    $queries = Debug::$queries;
    if (!empty($queries)) {
        foreach ($queries as $query) {
            echo $query."<br>";
        }
    }

    //Ошибки mysql
    $errors = Debug::$mysqlErrors;
    if (!empty($errors)) {
        echo '<br>Errors:<br>';
        foreach ($errors as $error) {
            echo $error."<br>";
        }
    }
}