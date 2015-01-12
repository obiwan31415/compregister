CREATE TABLE IF NOT EXISTS `#__comp_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `macaddress` varchar(17) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `room` varchar(25) NOT NULL,
  `fixedip` varchar(25) NOT NULL,
  `comment` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;