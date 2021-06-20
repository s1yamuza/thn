USE thn;

CREATE TABLE `hotel` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `slug_name` varchar(50) NOT NULL,
    `rooms`  smallint(1) unsigned NOT NULL DEFAULT 1,
    `score`  decimal(1, 1) unsigned NOT NULL DEFAULT 0,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `slug_name` (`slug_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `thn`.`hotel` (`name`, `slug_name`, `rooms`) VALUES ('May Ramblas Hotel Barcelona', 'may_ramblas_hotel_barcelona', 400);
INSERT INTO `thn`.`hotel` (`name`, `slug_name`, `rooms`) VALUES ('The Plaza', 'the_plaza', 300);
INSERT INTO `thn`.`hotel` (`name`, `slug_name`, `rooms`) VALUES ('Waldorf Astoria Amsterdam', 'waldorf_astoria_amsterdam', 500);