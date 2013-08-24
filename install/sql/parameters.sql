--
-- Дамп данных таблицы `parameters`
--

INSERT INTO `parameters` (`name`, `value`, `type`, `title`, `group_id`, `hide`, `ordering`) VALUES
('403_section', '34', 'section', 'options_403_section', 1, 1, 3),
('404_section', '13', 'section', 'options_404_section', 1, 0, 4),
('activation_section', '', 'section', 'options_activation_section', 2, 1, 6),
('auth_section', '6', 'section', 'options_auth_section', 2, 1, 7),
('debug', '', 'checkbox', 'options_debug', 1, 0, 2),
('default_section', '7', 'section', 'options_main_section', 1, 0, 5),
('recover_section', '', 'section', 'options_recover_section', 2, 1, 8),
('reg_section', '', 'section', 'options_reg_section', 2, 1, 9),
('sef', '1', 'checkbox', 'options_sef_on', 1, 0, 1),
('default_admin_section', '1', '', '', 1, 1, 0),
('meta_title', '', 'textarea', 'options_sitetitle', 3, 0, 1),
('meta_description', '', 'textarea', 'options_sitedescription', 3, 0, 2),
('meta_keywords', '', 'textarea', 'options_sitekeywords', 3, 0, 3),
('404_section_admin', '36', 'section', 'options_404_section_admin', 1, 1, 0),
('end', '/', 'text', 'options_url_end', 1, 0, 6),
('language', 'russian', 'language', 'options_language', 1, 0, 8);

-- --------------------------------------------------------
--
-- Дамп данных таблицы `parameters_group`
--

INSERT INTO `parameters_group` (`id`, `title`, `ordering`) VALUES
(1, 'options_main_parameters', 1),
(2, 'options_auth_parameters', 2),
(3, 'options_seo_parameters', 3);