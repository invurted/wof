CREATE TABLE IF NOT EXISTS `users` (
   `id` INT unsigned NOT NULL AUTO_INCREMENT,
   `username` varchar(20) NOT NULL,
   `email` varchar(75) NOT NULL,
   `password` char(64) NOT NULL,
   PRIMARY KEY (`id`),
   UNIQUE(`username`),
   UNIQUE(`email`)
) Engine=MyISAM;