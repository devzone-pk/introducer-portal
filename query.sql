### DDL Command for Complaints Table

CREATE TABLE `complaints`
(
    `id`          int                                       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `option_id`   int(10) unsigned                          NOT NULL,
    `customer_id` bigint(20) unsigned                       NOT NULL,
    `transfer_id` bigint(20) unsigned                       NULL,
    `description` text COLLATE 'utf8mb4_unicode_ci'         NULL,
    `status`      varchar(191) COLLATE 'utf8mb4_unicode_ci' NULL,
    `created_at`  timestamp                                 NOT NULL,
    `updated_at`  timestamp                                 NOT NULL,
    FOREIGN KEY (`option_id`) REFERENCES `options` (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
    FOREIGN KEY (`transfer_id`) REFERENCES `transfers` (`id`)
) ENGINE = 'InnoDB'
  COLLATE 'utf8mb4_unicode_ci';

#Foreign Key Constraints are dropped since transfer_id was nullable in case user selects other options from complaint type

ALTER TABLE `complaints`
    DROP FOREIGN KEY `complaints_ibfk_1`;

ALTER TABLE `complaints`
    DROP FOREIGN KEY `complaints_ibfk_3`;

ALTER TABLE `complaints`
    DROP FOREIGN KEY `complaints_ibfk_2`;
