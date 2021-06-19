USE thn;

CREATE TABLE `user`
(
    `id`                int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name`              varchar(50)          DEFAULT NULL,
    `email`             varchar(50) NOT NULL DEFAULT '',
    `active`            tinyint(1) unsigned NOT NULL DEFAULT '1',
    `created_at`        timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`        datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
