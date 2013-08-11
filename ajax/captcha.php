<?php
/**
 * Случайная картинка
 *
 * @project SamCMS
 * @package Ajax
 * @author Kash
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
session_start();
require_once __DIR__."/../loader.php";

$captcha = new Captcha();
$captcha->generate();
