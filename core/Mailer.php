<?php

/**
 * Класс для отправки писем
 *
 * @project SamCMS
 * @package core
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Mailer extends Core {

    /**
     * Отправляет письмо
     *
     * @static
     * @param $mailTo
     * @param $mailFrom
     * @param $subject
     * @param $body
     * @return bool
     */
    public static function sendMail($mailTo, $mailFrom, $subject, $body) {

        $headers = "Content-type: text/html; charset=\"utf-8\"\n";
        $headers.= "From: $mailFrom\n";

        return mail($mailTo, $subject, $body, $headers, '-f '.$mailFrom);
    }
}