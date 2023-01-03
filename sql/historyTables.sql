USE `pd`;

--
-- Table printer_history stores daily consumption value as well as past consumption
--
-- Note that "consumption" = pages printed TODAY
-- 	"toner_pages_printed" = pages printed with CURRENT TONER CART, TO DATE (not incuding today)
--

CREATE TABLE IF NOT EXISTS `printer_history` (
	`id` int(32) AUTO_INCREMENT PRIMARY KEY,
	`printer_name` varchar(64) NOT NULL,
	`printer_ip` varchar(16) NOT NULL,
	`toner_color` varchar(16) DEFAULT NULL,
	`day_measured` date DEFAULT NULL,
	`consumption` int(16) DEFAULT NULL,
	`toner_pages_printed` int(16) DEFAULT NULL
);

ALTER TABLE `printer_history`
  ADD CONSTRAINT `history_printerfk` FOREIGN KEY (`printer_name`, `printer_ip`)
    REFERENCES `printer` (`name`, `ip`);

CREATE INDEX get_history
ON printer_history (printer_ip, printer_name, toner_color);


/*

CREATE TABLE `mapped_history` (
	`id` int(32) UNSIGNED NOT NULL AUTO_INCREMENT,
	`toner_color` varchar(16) DEFAULT NULL,
	`day_measured` date DEFAULT NULL,
	`consumption` int(16) DEFAULT NULL,
	`toner_pages_printed` int(16) DEFAULT NULL,
	PRIMARY KEY (`id`)
);



CREATE TABLE `history_map` (
	`hist_id` int(32) UNSIGNED NOT NULL,
	`printer_name` varchar(64) NOT NULL,
	`printer_ip` varchar(64) NOT NULL,

	PRIMARY KEY (`hist_id`, `printer_name`, `printer_ip`),
	INDEX (`hist_id`),
	INDEX (`printer_name`, `printer_ip`)
);

ALTER TABLE `history_map`
  ADD CONSTRAINT `history_map_printerfk` FOREIGN KEY (`printer_name`, `printer_ip`)
    REFERENCES `printer` (`name`, `ip`);
ALTER TABLE `history_map`
  ADD CONSTRAINT `history_map_histfk` FOREIGN KEY (`hist_id`)
    REFERENCES `mapped_history` (`id`);

*/