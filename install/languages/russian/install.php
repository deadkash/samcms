<?php
/**
 * Языковые переменные
 *
 * @project SamCMS
 * @package Language
 * @author Kash
 * @date 20.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

$language = array();

$language['install_title'] = 'Мастер установки SamCMS';
$language['install_superuser_group'] = 'Администратор';
$language['install_unreg_group'] = 'Посетитель сайта';
$language['install_reg_group'] = 'Зарегистрированный пользователь';
$language['install_admin_panel'] = 'Административная панель';
$language['install_404_error'] = '404 ошибка';
$language['install_404_error_text'] = 'Страница, которую вы запросили, где-то затерялась :(';
$language['install_403_error'] = 'Доступ запрещен';
$language['install_403_error_text'] = 'Вы запросили страницу, доступ к которой вам запрещен!';
$language['install_main_user_menu'] = 'Основное меню';
$language['install_main_title'] = 'Главная';
$language['install_404_content'] = '404 ошибка';

$language['install_welcome'] = 'Добро пожаловать';
$language['install_welcome_subtext'] = 'в мастер установки SamCMS';
$language['install_welcome_description1'] = 'Чтобы начать пользоваться системой управлением контентом SamCMS, необходимо установить ее на ваш сервер. Для этого пройдите несколько простых шагов установки.';
$language['install_welcome_description2'] = 'Перед началом установки выберите язык установки.';
$language['install_welcome_select_language'] = 'Выберите язык установки';
$language['install_welcome_continue'] = 'Продолжить';

$language['install_config_step1'] = 'Шаг 1';
$language['install_config_step1_desc'] = 'Начальная конфигурация';
$language['install_config_db'] = 'База данных';
$language['install_config_dbhost'] = 'Сервер';
$language['install_config_dbuser'] = 'Пользователь';
$language['install_config_dbpass'] = 'Пароль';
$language['install_config_dbname'] = 'Имя базы данных';
$language['install_config_theme'] = 'Выбор темы';
$language['install_config_theme_site'] = 'Тема сайта';
$language['install_config_theme_admin'] = 'Тема системы управления';
$language['install_config_back'] = 'Вернуться к выбору языка';
$language['install_config_continue'] = 'Дальше';

$language['install_user_step2'] = 'Шаг 2';
$language['install_user_step2_desc'] = 'Создание пользователя';
$language['install_user_description'] = 'Необходимо создать учетную запись администратора системы управления. Используя данные, введенные ниже, вы будете заходить в систему администрирования.';
$language['install_user_login'] = 'Логин';
$language['install_user_login_desc'] = 'Логин должен состоять из латинских букв и цифр';
$language['install_user_pass'] = 'Пароль';
$language['install_user_pass_confirm'] = 'Повторите пароль';
$language['install_user_continue'] = 'Дальше';

$language['install_params_step3'] = 'Шаг 3';
$language['install_params_step3_desc'] = 'Описание сайта';
$language['install_params_continue'] = 'Дальше';
$language['install_params_metatitle'] = 'Название сайта';
$language['install_params_metakeywords'] = 'Ключевые слова сайта';
$language['install_params_metadescription'] = 'Описание сайта';

//Сообщения
$language['builder_msg_dbhost_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Сервер"!';
$language['builder_msg_dbuser_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Пользователь"!';
$language['builder_msg_dbpass_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Пароль"!';
$language['builder_msg_dbname_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Имя базы данных"!';
$language['builder_msg_login_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Логин"!';
$language['builder_msg_email_error_email'] = '<strong>Ошибка:</strong> Введите валидный E-mail!';
$language['builder_msg_email_error_required'] = '<strong>Ошибка:</strong> Заполните поле "E-mail"!';
$language['builder_msg_password_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Пароль"!';
$language['builder_msg_confirm_password_error_required'] = '<strong>Ошибка:</strong> Заполните поле "Повторите пароль"!';
$language['install_dbconnect_error'] = '<strong>Ошибка:</strong> Не удалось подключиться к Базе данных!';
$language['install_password_not_match'] = '<strong>Ошибка:</strong> Введенные пароли не совпадают!';
$language['install_password_too_short'] = '<strong>Ошибка:</strong> Пароль слишком короткий!';

return $language;