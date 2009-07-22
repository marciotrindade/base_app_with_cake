CREATE TABLE `pages` (
  `id` int(11) NOT NULL auto_increment,
  `permalink` varchar(100) collate utf8_unicode_ci NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `metatitle` varchar(255) collate utf8_unicode_ci NOT NULL,
  `metadescription` text collate utf8_unicode_ci NOT NULL,
  `metakeywords` varchar(255) collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL default '0',
  `page_count` int(11) NOT NULL default '0',
  `position` int(11) NOT NULL default '100',
	`protected` tinyint(1) NOT NULL default '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `permalink` (`permalink`),
  KEY `page_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
