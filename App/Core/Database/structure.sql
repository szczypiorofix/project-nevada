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

SET NAMES 'utf8';
SET CHARACTER SET 'UTF8';


/**
-------------------------- USERS --------------------------
*/
CREATE TABLE IF NOT EXISTS  `users` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'User Id',
    `email` VARCHAR(30) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'User mail',
    `password` TEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'User password',
    `date_registered` DATETIME NOT NULL COMMENT 'Registered',
    `date_login` DATETIME NOT NULL COMMENT 'Last online',
    `session_code` CHAR(32) NOT NULL COMMENT 'session code',
    `first_login_failed` INT NOT NULL COMMENT 'Timestamp of first login failure',
    `failed_login_count` INT NOT NULL DEFAULT '0' COMMENT 'Failed login counter',
    PRIMARY KEY(`id`)
)
COMMENT='Users table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- CATEGORIES --------------------------
*/
CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Category Id' PRIMARY KEY,
    `name` VARCHAR(30) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Category name'
)
COMMENT='Categories table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- TAGS --------------------------
*/
CREATE TABLE IF NOT EXISTS `tags` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Tag Id' PRIMARY KEY,
    `name` VARCHAR(30) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Tag name',
    FULLTEXT (`name`)
)
COMMENT='Tags table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- POSTS --------------------------
*/
CREATE TABLE IF NOT EXISTS  `posts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id' PRIMARY KEY,
    `title` VARCHAR (150) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Title',
    `description` VARCHAR (250) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Description',
    `content` TEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Content',
    `url` VARCHAR(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'post URL',
    `image` VARCHAR(50) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Image file',
    `image_description` TEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Image file description',
    `insert_date` DATETIME NOT NULL COMMENT 'Insert date',
    `update_date` DATETIME NOT NULL COMMENT 'Update date',
    FULLTEXT (`title`, `description`, `content`)
)
COMMENT='Posts data'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- COMMENTS --------------------------
*/
CREATE TABLE IF NOT EXISTS  `comments` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Comment Id' PRIMARY KEY,
    `idpost` INT UNSIGNED NOT NULL COMMENT 'Post Id',
    `email` VARCHAR(60) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'User e-mail',
    `comment` TEXT COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Content',
    `insert_date` DATETIME NOT NULL COMMENT 'Date',
    FOREIGN KEY(`idpost`) REFERENCES `posts` (`id`)
)
COMMENT='Comments table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- POST CATEGORIES --------------------------
*/
CREATE TABLE IF NOT EXISTS `post_categories` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Post-categories Id' PRIMARY KEY,
    `categoryid` INT UNSIGNED NOT NULL COMMENT 'Category Id',
    `postid` INT UNSIGNED NOT NULL COMMENT 'Post Id',
    FOREIGN KEY(`categoryid`) REFERENCES `categories` (`id`),
    FOREIGN KEY(`postid`) REFERENCES `posts` (`id`)
)
COMMENT='Post-categories Table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- POST TAGS --------------------------
*/
CREATE TABLE IF NOT EXISTS `post_tags` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Post-tags Id' PRIMARY KEY,
    `tagid` INT UNSIGNED NOT NULL COMMENT 'Tag Id',
    `postid` INT UNSIGNED NOT NULL COMMENT 'Post Id',
    FOREIGN KEY(`tagid`) REFERENCES `tags` (`id`),
    FOREIGN KEY(`postid`) REFERENCES `posts` (`id`)
)
COMMENT='Post-tags Table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;



/**
-------------------------- FILES TO DOWNLOAD --------------------------
*/
CREATE TABLE IF NOT EXISTS `filestodownload` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'File Id' PRIMARY KEY,
    `file_name` VARCHAR(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'File name',
    `description` VARCHAR(250) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'File description',
    `download_counter` INT UNSIGNED NOT NULL COMMENT 'Download counter',
    `insert_date` DATETIME NOT NULL COMMENT 'Upload date'
)
COMMENT='Files to download table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;


/**
-------------------------- TEQUILA BEST SCORES --------------------------
*/
CREATE TABLE IF NOT EXISTS `tequilabestscores` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Score Id' PRIMARY KEY,
    `name` VARCHAR(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'Player name',
    `score` INT(11) NOT NULL COMMENT 'Player score',
    `millis` INT(11) NOT NULL COMMENT 'Time in ms.',
    `level` INT UNSIGNED NOT NULL COMMENT 'Level',
    `insert_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Insert date'
)
COMMENT='Best scores of Tequila Platformer'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;


/**
-------------------------- CONFIG --------------------------
*/
CREATE TABLE IF NOT EXISTS `config` (
    `name` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_unicode_ci' COMMENT 'Value name',
    `value` TEXT NOT NULL COLLATE 'utf8mb4_unicode_ci' COMMENT 'Value',
    `update_time` DATETIME NULL DEFAULT NULL COMMENT 'Update date',
    `previous_value` TEXT NULL COLLATE 'utf8mb4_unicode_ci' COMMENT 'Previous value',
    PRIMARY KEY(`name`)
)
COMMENT='Configuration'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;


/**
-------------------------- SUBMISSIONS --------------------------
*/
CREATE TABLE IF NOT EXISTS `submissions` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Subscription Id' PRIMARY KEY,
    `email` VARCHAR(200) COLLATE 'utf8mb4_unicode_ci' NOT NULL COMMENT 'E-mail',
    `insert_date` DATETIME NOT NULL COMMENT 'Insert date'
)
COMMENT='Subscriptions table'
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB
;