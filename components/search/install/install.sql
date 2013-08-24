--
-- Структура таблицы `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(512) DEFAULT NULL,
  `index` text,
  `href` varchar(512) DEFAULT NULL,
  `element_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `element_id` (`element_id`,`type`),
  FULLTEXT KEY `index` (`index`,`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;