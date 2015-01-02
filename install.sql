CREATE TABLE IF NOT EXISTS `#__comp_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `macaddress` varchar(12) NOT NULL,
  `compname` varchar(25) NOT NULL,
  `workgroup` varchar(25) DEFAULT NULL,
  `wallsocket` varchar(25) NOT NULL,
  `primarysystem` varchar(25) NOT NULL,
  `secondarysystem` varchar(25) DEFAULT NULL,
  `comments` text,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `room` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;