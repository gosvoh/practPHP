SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `bank`;
CREATE DATABASE bank;

USE bank;

CREATE TABLE `Individuals` (
  `id` INT NOT NULL,
  `first_name` VARCHAR(30) NOT NULL,
  `last_name` VARCHAR(30) NOT NULL,
  `middle_name` VARCHAR(30) DEFAULT NULL,
  `passport` VARCHAR(30) NOT NULL,
  `INN` VARCHAR(12) NOT NULL,
  `SNILS` VARCHAR(11) NOT NULL,
  `license` VARCHAR(30) DEFAULT NULL,
  `additional_docs` VARCHAR(30) DEFAULT NULL,
  `notes` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `Individuals` (`id`, `first_name`, `last_name`, `middle_name`, `passport`, `INN`, `SNILS`, `license`, `additional_docs`, `notes`) VALUES
(1, 'Иван', 'Иванов', 'Иванович', '1234 567890', 123456789012, 12345678901, '1234 567890', '1234 567890', '1234 567890'),
(2, 'Петр', 'Петров', 'Петрович', '1234 567890', 123456789012, 12345678901, '1234 567890', '1234 567890', '1234 567890'),
(3, 'Сидор', 'Сидоров', 'Сидорович', '1234 567890', 123456789012, 12345678901, '1234 567890', '1234 567890', '1234 567890'),
(4, 'Александр', 'Александров', 'Александрович', '1234 567890', 123456789012, 12345678901, '1234 567890', '1234 567890', '1234 567890'),
(5, 'Андрей', 'Андреев', 'Андреевич', '1234 567890', 123456789012, 12345678901, '1234 567890', '1234 567890', '1234 567890');

COMMIT;