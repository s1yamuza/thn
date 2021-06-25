USE thn;

CREATE TABLE `reservation` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`hotel_id` int(11) NOT NULL,
	`room_number` int(11) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `hotel_id` (`hotel_id`, `room_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `thn`.`reservation` (`user_id`, `hotel_id`, `room_number`) VALUES ('3', '1', '301');
INSERT INTO `thn`.`reservation` (`user_id`, `hotel_id`, `room_number`) VALUES ('2', '1', '120');
INSERT INTO `thn`.`reservation` (`user_id`, `hotel_id`, `room_number`) VALUES ('3', '1', '400');
