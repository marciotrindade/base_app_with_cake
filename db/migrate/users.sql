CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(20) collate utf8_unicode_ci NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci NOT NULL,
  `name` varchar(120) collate utf8_unicode_ci NOT NULL,
  `email` varchar(120) collate utf8_unicode_ci NOT NULL,
  `logged` date default NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert into `users` values
('1','marciotrindade','AmxWJgduAmdXOgNtAjkANw==','Marcio','marciotrindade@gmail.com','2009-01-12','2008-02-21 18:57:12','2009-01-12 13:44:05');
