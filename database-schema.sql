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

-- Create a table with columns and comments
CREATE TABLE `user_tbl` (
    -- Primary key column
    `user_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `fname` VARCHAR(50) NOT NULL COMMENT 'Firstname',
    `sname` VARCHAR(50) NOT NULL COMMENT 'Surname',
    `oname` VARCHAR(50) COMMENT 'Other name',
    `email` VARCHAR(150) NOT NULL COMMENT 'User email address',
    `pwd` VARCHAR(255) COMMENT 'User password',
    `user_type` VARCHAR(100) NOT NULL COMMENT '(Admin | User )',
    `passport` VARCHAR(200) NULL COMMENT 'User image',
    `date_reg` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of registration',
    `last_login` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `act_status` TINYINT NOT NULL COMMENT 'Account status (1 active, 0 inactive)'
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_general_ci;