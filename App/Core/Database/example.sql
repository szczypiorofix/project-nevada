/* 
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */
/**
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 * Created: 2018-03-13
 */


/* ###### PRZYKŁADOWE WARTOŚCI ######## */
/**
-------------------------- SETTINGS --------------------------
*/
SET NAMES 'utf8';
SET CHARACTER SET 'UTF8';
-- SET FOREIGN_KEY_CHECKS = 0;



/**
-------------------------- CONFIG --------------------------
*/
INSERT INTO
    `config` (`name`, `value`, `update_time`, `previous_value`)
VALUES
    ('Author', 'Wróblewski Piotr', NOW(), ' ');



/**
-------------------------- CATEGORIES --------------------------
*/
INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'programowanie'),
(2, 'grafika'),
(3, 'gry'),
(4, 'informacje'),
(5, 'projekty');


/**
-------------------------- TAGS --------------------------
*/

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Android'),
(2, 'info'),
(3, 'game'),
(4, 'web'),
(5, 'PHP'),
(6, 'MySQL'),
(7, 'CSS'),
(8, 'Java'),
(9, 'JavaScript'),
(10, 'jQuery'),
(11, 'desktop'),
(12, 'software'),
(13, 'phone'),
(14, 'hardware'),
(15, 'pixel-art'),
(16, 'Bootstrap'),
(17, 'important'),
(18, 'C#'),
(19, 'C'),
(20, 'pico-8'),
(21, 'Unity3D'),
(22, 'UE4'),
(23, 'GameMaker'),
(24, 'Articy-Draft'),
(25, 'Hexels'),
(26, 'Star Wars'),
(27, 'Twine');


/**
-------------------------- TEQUILA PLATFORMER SCORES --------------------------
*/
INSERT INTO `tequilabestscores` (`id`, `name`, `score`, `millis`, `level`, `insert_date`) VALUES
(12, 'damoch', 2050, 118720, 1, '2017-03-04 23:13:15'),
(13, 'damoch', 1955, 82000, 2, '2017-03-04 23:13:15'),
(14, '', 1465, 67184, 3, '2017-03-04 23:13:15'),
(15, '', 1960, 106288, 1, '2017-03-04 23:13:15'),
(16, '', 3975, 96608, 2, '2017-03-04 23:13:15'),
(17, '', 3445, 98176, 3, '2017-03-04 23:13:15'),
(24, 'seba', 2910, 180080, 1, '2017-03-04 23:13:15'),
(25, 'kkk', 3230, 173616, 1, '2017-03-04 23:13:15'),
(26, 'kkk', 4040, 127056, 2, '2017-03-04 23:13:15'),
(27, 'kkk', 3625, 118128, 3, '2017-03-04 23:13:15'),
(28, 'aleksandra', 3120, 155872, 1, '2017-03-04 23:13:15'),
(29, 'Karol', 2960, 198304, 1, '2017-03-04 23:13:15'),
(30, '', 3130, 192160, 1, '2017-03-04 23:13:15'),
(31, 'ochodzki', 3230, 187248, 1, '2017-03-04 23:30:31'),
(32, 'ochodzki', 3305, 192592, 1, '2017-03-05 00:14:36'),
(33, 'ochodzki', 4010, 178624, 2, '2017-03-05 00:17:44'),
(34, 'Karol', 3200, 131488, 1, '2017-03-21 15:15:11'),
(35, 'Karol', 4020, 107696, 2, '2017-03-21 15:17:04'),
(36, 'Zdzicho', 2265, 100576, 1, '2017-03-23 09:45:02'),
(37, 'Zdzich', 2790, 106736, 1, '2017-03-23 09:49:09'),
(38, 'Misiek', 2790, 73216, 4, '2017-04-18 14:36:12'),
(39, 'tomasz', 825, 94176, 1, '2017-04-26 23:36:10'),
(40, 'TOMASZ', 2475, 104864, 2, '2017-04-26 23:40:31'),
(41, 'TOMASZ', 1405, 69008, 3, '2017-04-26 23:44:04'),
(42, 'aaa', 3260, 185696, 1, '2017-04-27 15:47:00'),
(43, 'aaa', 3975, 111984, 2, '2017-04-27 15:48:57'),
(44, 'aaa', 3645, 111216, 3, '2017-04-27 15:50:54'),
(45, 'aaa', 3955, 118192, 4, '2017-04-27 15:52:58'),
(46, 'aaa', 940, 75024, 5, '2017-04-27 15:54:16'),
(47, 'Chimerian', 3310, 180592, 1, '2017-05-17 18:12:33'),
(48, 'Chimerian', 4100, 136960, 2, '2017-05-17 18:14:59'),
(49, 'Janusz', 3320, 174256, 1, '2018-01-16 13:19:21'),
(50, 'Janusz', 3820, 179408, 2, '2018-01-16 13:22:31'),
(51, 'Janusz', 3445, 115584, 3, '2018-01-16 13:36:46'),
(52, 'Janusz', 4135, 146800, 4, '2018-01-16 14:05:57'),
(53, 'Janusz', 970, 69440, 5, '2018-01-16 14:08:08'),
(54, 'Janusz', 2360, 103232, 6, '2018-01-19 00:28:23'),
(55, 'Janusz', 1865, 105776, 7, '2018-01-19 00:35:36'),
(56, 'Janusz', 3730, 181424, 8, '2018-01-22 12:59:34'),
(57, 'Janusz', 1515, 92080, 9, '2018-01-22 13:28:08');


-- SET FOREIGN_KEY_CHECKS = 1;