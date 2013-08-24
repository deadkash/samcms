--
-- Структура таблицы `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `success_text` text NOT NULL,
  `send_admin_email` int(1) NOT NULL,
  `admin_email` varchar(512) DEFAULT NULL,
  `send_answer` int(1) DEFAULT NULL,
  `answer_subject` text,
  `answer_text` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `forms_fields`
--

CREATE TABLE IF NOT EXISTS `forms_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) DEFAULT NULL,
  `title` varchar(512) DEFAULT NULL,
  `description` text NOT NULL,
  `type` varchar(512) DEFAULT NULL,
  `validation` varchar(255) NOT NULL,
  `error_text` varchar(512) NOT NULL,
  `class` varchar(255) NOT NULL,
  `required` int(1) NOT NULL,
  `default` text,
  `form_id` int(11) DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;