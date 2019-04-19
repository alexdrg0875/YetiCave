SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `bets`;
CREATE TABLE `bets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt_add` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `lot_id` int(11) unsigned NOT NULL,
  `bet` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `lot_id` (`lot_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lots`;
CREATE TABLE `lots` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `dt_add` datetime NOT NULL,
  `dt_end` datetime NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `bet_step` int(11) NOT NULL DEFAULT '0',
  `title` char(255) NOT NULL,
  `alt_title` char(50) NOT NULL DEFAULT 'Фотография лота',
  `description` text,
  `path` char(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dt_add` datetime NOT NULL,
  `email` char(128) NOT NULL,
  `name` char(128) NOT NULL,
  `password` char(64) NOT NULL,
  `avatar_path` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE INDEX u_bet ON bets(user_id);
CREATE INDEX l_bet ON bets(lot_id);
--ALTER TABLE `gifs_like` ADD UNIQUE INDEX (`user_id`, `gif_id`);
--ALTER TABLE `gifs_fav` ADD UNIQUE INDEX (`user_id`, `gif_id`) ;

--ALTER TABLE `users` ADD COLUMN `token` char(32) NOT NULL AFTER `avatar_path`;