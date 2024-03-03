-- Drop database
DROP DATABASE IF EXISTS mailcorvid_db;

-- Create database + user if doesn't exist
CREATE DATABASE IF NOT EXISTS mailcorvid_db;
CREATE USER IF NOT EXISTS 'mailcorvid_user'@'localhost';
SET PASSWORD FOR 'mailcorvid_user'@'localhost' = 'mailcorvid_user_@123';
GRANT ALL ON mailcorvid_db.* TO 'mailcorvid_user'@'localhost';
GRANT SELECT ON performance_schema.* TO 'mailcorvid_user'@'localhost';
FLUSH PRIVILEGES;

-- Use the created database
USE mailcorvid_db;


--
-- Table structure for table `staff_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;

-- Create a user table columns
CREATE TABLE `user_tbl` (
    -- Primary key column
    `user_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `fname` VARCHAR(50) NOT NULL COMMENT 'Firstname',
    `sname` VARCHAR(50) NOT NULL COMMENT 'Surname',
    `oname` VARCHAR(50) COMMENT 'Other name',
    `username` VARCHAR(150) COMMENT 'username',
    `email` VARCHAR(150) NOT NULL COMMENT 'User email address',
    `pwd` VARCHAR(255) COMMENT 'User password',
    `user_type` VARCHAR(100) NOT NULL COMMENT '(Admin | User )',
    `passport` VARCHAR(200) NULL COMMENT 'User image',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of registration',
    `last_login` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `act_status` TINYINT NOT NULL COMMENT 'Account status (1 active, 0 inactive)'
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_general_ci;


-- Insert record into user table
INSERT INTO user_tbl(fname, sname, oname, email, pwd, user_type, passport) 
VALUES('John', 'Doe', '', 'username', 'admin@admin.com', 'pwd', 'user', '');


-- Create message table columns
CREATE TABLE `message_tbl` (
    -- Primary key column
    `message_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `category_id` INT NOT NULL,
    `subject` VARCHAR(150) NOT NULL,
    `body` TEXT COMMENT 'Message body',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp'
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_general_ci;


-- Create category table columns
CREATE TABLE `message_tbl` (
    -- Primary key column
    `category_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `category_name` VARCHAR(150) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp'
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_general_ci;


-- Create contact table columns
CREATE TABLE `contact_tbl` (
    -- Primary key column
    `contact_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user_id` INT NOT NULL,
    `fname` VARCHAR(150) NOT NULL COMMENT 'first name',
    `lname` VARCHAR(150) NOT NULL COMMENT 'last name',
    `oname` VARCHAR(150) NOT NULL COMMENT 'other name',
    `email_address` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp'
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_general_ci;


-- Create block_contact table columns
CREATE TABLE `block_contact_tbl` (
    -- Primary key column
    `block_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `user_id` INT NOT NULL,
    `block_contact_id` INT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp'
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_general_ci;
