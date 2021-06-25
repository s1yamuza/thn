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
