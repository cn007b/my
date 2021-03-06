CREATE TABLE `types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `intT` tinyint(4) NOT NULL DEFAULT '0',
  `intS` smallint(6) NOT NULL DEFAULT '0',
  `intM` mediumint(9) NOT NULL DEFAULT '0',
  `intI` int(11) NOT NULL DEFAULT '0',
  `intB` bigint(20) NOT NULL DEFAULT '0',
  `floatF` float(3,1) NOT NULL DEFAULT '0.0',
  `doubleD` double(25,24) NOT NULL DEFAULT '0.000000000000000000000000',
  `bitB` bit(1) NOT NULL DEFAULT b'0',
  `dateD` date NOT NULL DEFAULT '0000-00-00',
  `dateDT` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateTS` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateT` time NOT NULL DEFAULT '00:00:00',
  `dateY` year(4) NOT NULL DEFAULT '0000',
  `dateY2` year(2) NOT NULL DEFAULT '00',
  `dateY4` year(4) NOT NULL DEFAULT '0000',
  `stringC` char(5) NOT NULL DEFAULT '',
  `stringVC` varchar(7) NOT NULL DEFAULT '',
  `stringB` binary(5) NOT NULL DEFAULT '\0\0\0\0\0',
  `stringVB` varbinary(7) NOT NULL DEFAULT '',
  `blobT` tinyblob NOT NULL,
  `blobB` blob NOT NULL,
  `blobM` mediumblob NOT NULL,
  `blobL` longblob NOT NULL,
  `textTT` tinytext NOT NULL,
  `textT` text NOT NULL,
  `textM` mediumtext NOT NULL,
  `textL` longtext NOT NULL,
  `e` enum('foo','boo') NOT NULL DEFAULT 'foo',
  `s` set('a','b','c') NOT NULL DEFAULT 'a',
  `geometryG` geometry NOT NULL DEFAULT '',
  `pointP` point NOT NULL DEFAULT '',
  `linestringL` linestring NOT NULL DEFAULT '',
  `polygonP` polygon NOT NULL DEFAULT '',
  `multipointM` multipoint NOT NULL DEFAULT '',
  `multilinestringM` multilinestring NOT NULL DEFAULT '',
  `multipolygonM` multipolygon NOT NULL DEFAULT '',
  `geometrycollectionG` geometrycollection NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
;
