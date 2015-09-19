-- Users.

CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- places.

CREATE TABLE IF NOT EXISTS `place` (
  `title` varchar(200) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image` mediumblob DEFAULT NULL,
  `imageType` varchar(25) DEFAULT NULL,
  `lon` DECIMAL(12,9) NOT NULL,
  `lat` DECIMAL(12,9)  NOT NULL,
  `ownerid` varchar(200) NOT NULL,
  PRIMARY KEY(`title`, `lon`, `lat`),
  FOREIGN KEY (`ownerid`) REFERENCES `user`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;