CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `slug` varchar(30) collate utf8_unicode_ci NOT NULL,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into `groups` values
  ('1','adm','Administrator'),
  ('2','usr','User');
