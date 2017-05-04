CREATE TABLE `type`(
`id` int AUTO_INCREMENT NOT NULL,
`description` varchar(25) NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB;

CREATE TABLE `users` (
`id` int AUTO_INCREMENT NOT NULL,
`name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
`created` datetime NOT NULL,
`modified` datetime NOT NULL,
`password` varchar(25) NOT NULL,
`signiture` mediumblob, 
`status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
`dateOfAward`  DATE NOT NULL,
`specialID` int NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (specialID) REFERENCES type(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `org`(
`id` int AUTO_INCREMENT NOT NULL,
`description` varchar(100) NOT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB;

CREATE TABLE `award`(
`id` int AUTO_INCREMENT NOT NULL,
`userID` int,
`orgID` int NOT NULL,
`name` varchar(50) NOT NULL,
`email` varchar(100) NOT NULL,
`dateOfAward` DATE NOT NULL, 
`autoFill` varchar(100) DEFAULT 'GREAT JOB!',
PRIMARY KEY (`id`),
FOREIGN KEY (userID) REFERENCES users(id) ON DELETE SET NULL,
FOREIGN KEY (orgID) REFERENCES org(id)
)ENGINE=InnoDB;