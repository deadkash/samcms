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

$language['install_title'] = 'SamCMS setup wizard';
$language['install_superuser_group'] = 'Administrator';
$language['install_unreg_group'] = 'Unregister user';
$language['install_reg_group'] = 'Register user';
$language['install_admin_panel'] = 'Admin panel';
$language['install_404_error'] = 'Error 404';
$language['install_404_error_text'] = 'The page you requested is lost somewhere: (';
$language['install_403_error'] = 'Access denied';
$language['install_403_error_text'] = 'You requested a page to which access is denied to you!';
$language['install_main_user_menu'] = 'Main menu';
$language['install_main_title'] = 'Start';

$language['install_welcome'] = 'Welcome';
$language['install_welcome_subtext'] = 'to SamCMS setup wizard';
$language['install_welcome_description1'] = 'To start using a content management system SamCMS, you must install it on your server. To do this, go a few simple installation steps.';
$language['install_welcome_description2'] = 'Before starting the installation, select the installation language.';
$language['install_welcome_select_language'] = 'Select the installation language';
$language['install_welcome_continue'] = 'Proceed';

$language['install_config_step1'] = 'Step 1';
$language['install_config_step1_desc'] = 'Initial configuration';
$language['install_config_db'] = 'Database';
$language['install_config_dbhost'] = 'Host';
$language['install_config_dbuser'] = 'User';
$language['install_config_dbpass'] = 'Paassword';
$language['install_config_dbname'] = 'Database name';
$language['install_config_theme'] = 'Choosing a theme';
$language['install_config_theme_site'] = 'Site theme';
$language['install_config_theme_admin'] = 'Admin theme';
$language['install_config_back'] = 'Back to the language selector';
$language['install_config_continue'] = 'Next';

$language['install_user_step2'] = 'Step 2';
$language['install_user_step2_desc'] = 'Creating a User';
$language['install_user_description'] = 'You need to create an administrator account management system. Using data entered below, you will enter the system administration.';
$language['install_user_login'] = 'Login';
$language['install_user_login_desc'] = 'Login must consist of letters and numbers';
$language['install_user_pass'] = 'Password';
$language['install_user_pass_confirm'] = 'Confirm password';
$language['install_user_continue'] = 'Next';

$language['install_params_step3'] = 'Step 3';
$language['install_params_step3_desc'] = 'Site description';
$language['install_params_continue'] = 'Next';
$language['install_params_metatitle'] = 'Site name';
$language['install_params_metakeywords'] = 'Site keywords';
$language['install_params_metadescription'] = 'Site description';

//Сообщения
$language['builder_msg_dbhost_error_required'] = '<strong>Error:</strong> Fill in the "Server" field!';
$language['builder_msg_dbuser_error_required'] = '<strong>Error:</strong> Fill in the "User"!';
$language['builder_msg_dbpass_error_required'] = '<strong>Error:</strong> Fill in the "Password" field!';
$language['builder_msg_dbname_error_required'] = '<strong>Error:</strong> Fill in the "Database Name"!';
$language['builder_msg_login_error_required'] = '<strong>Error:</strong> Fill in the field "Login"!';
$language['builder_msg_email_error_email'] = '<strong>Error:</strong> Enter a valid E-mail!';
$language['builder_msg_email_error_required'] = '<strong>Error:</strong> Fill in the field "E-mail"!';
$language['builder_msg_password_error_required'] = '<strong>Error:</strong> Fill in the "Password" field!';
$language['builder_msg_confirm_password_error_required'] = '<strong>Error:</strong> Fill in the "Confirm password"!';
$language['install_dbconnect_error'] = '<strong>Error:</strong> Unable to connect to database!';
$language['install_password_not_match'] = '<strong>Error:</strong> The passwords do not match!';
$language['install_password_too_short'] = '<strong>Error:</strong> Password is too short!';

return $language;
