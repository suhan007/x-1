
--
-- Table structure for table `x_multidomain_config`
--

CREATE TABLE IF NOT EXISTS `x_multidomain_config` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(32) NOT NULL DEFAULT '',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `theme` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  UNIQUE KEY `domain` (`domain`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `x_multisite_config`
--

CREATE TABLE IF NOT EXISTS `x_multisite_config` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(32) NOT NULL DEFAULT '',
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `stamp_create` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `extra` text NOT NULL,
  PRIMARY KEY (`idx`),
  UNIQUE KEY `domain` (`domain`),
  KEY `mb_id` (`mb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

