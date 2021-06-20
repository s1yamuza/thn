USE thn;

CREATE TABLE `user`(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL DEFAULT '',
    `email` varchar(50) NOT NULL DEFAULT '',
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `thn`.`user` (`name`, `email`) VALUES ('Sergio Yamuza', 'sergioyamuza@gmail.com');
INSERT INTO `thn`.`user` (`name`, `email`) VALUES ('Saul Goodman', 'jmcgill@gmail.com');
INSERT INTO `thn`.`user` (`name`, `email`) VALUES ('Walter White', 'heisenberg@gmail.com');