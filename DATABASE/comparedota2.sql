-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for comparedota2
DROP DATABASE IF EXISTS `comparedota2`;
CREATE DATABASE IF NOT EXISTS `comparedota2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `comparedota2`;


-- Dumping structure for table comparedota2.match_detail_global
DROP TABLE IF EXISTS `match_detail_global`;
CREATE TABLE IF NOT EXISTS `match_detail_global` (
  `match_id` int(10) unsigned NOT NULL,
  `radiant_win` int(10) unsigned NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `match_seq_num` int(10) unsigned NOT NULL,
  `first_blood_time` int(10) unsigned NOT NULL,
  `lobby_type` int(10) unsigned NOT NULL,
  `game_mode` int(10) unsigned NOT NULL,
  PRIMARY KEY (`match_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Contains all data about the match and not the players';

-- Data exporting was unselected.


-- Dumping structure for table comparedota2.match_detail_players
DROP TABLE IF EXISTS `match_detail_players`;
CREATE TABLE IF NOT EXISTS `match_detail_players` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` int(20) unsigned NOT NULL,
  `id_32` int(20) unsigned DEFAULT NULL,
  `player_slot` int(10) unsigned DEFAULT NULL,
  `hero_id` int(10) unsigned NOT NULL,
  `item_0` int(10) unsigned NOT NULL,
  `item_1` int(10) unsigned NOT NULL,
  `item_2` int(10) unsigned NOT NULL,
  `item_3` int(10) unsigned NOT NULL,
  `item_4` int(10) unsigned NOT NULL,
  `item_5` int(10) unsigned NOT NULL,
  `kills` int(10) unsigned NOT NULL,
  `deaths` int(10) unsigned NOT NULL,
  `assists` int(10) unsigned NOT NULL,
  `leaver_status` int(10) unsigned NOT NULL,
  `gold` int(10) unsigned NOT NULL,
  `last_hits` int(10) unsigned NOT NULL,
  `denies` int(10) unsigned NOT NULL,
  `gold_per_min` int(10) unsigned NOT NULL,
  `xp_per_min` int(10) unsigned NOT NULL,
  `gold_spent` int(10) unsigned NOT NULL,
  `hero_damage` int(10) unsigned NOT NULL,
  `tower_damage` int(10) unsigned NOT NULL,
  `hero_healing` int(10) unsigned NOT NULL,
  `level` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Contains specific data for every player in that match';

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
