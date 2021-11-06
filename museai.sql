DROP DATABASE IF EXISTS museai;

CREATE DATABASE IF NOT EXISTS museai;

USE museai;

-- -----------------------------------------------------
-- Table `venue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `venue` (
  `idvenue` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `capacity` INT NULL,
  PRIMARY KEY (`idvenue`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));

INSERT INTO `venue` (`idvenue`, `name`, `capacity`) VALUES
(1, 'RIT', 1);

-- -----------------------------------------------------
-- Table `museai`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `museai` (
  `idmuseai` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `artist` VARCHAR(50) NOT NULL,
  `year` VARCHAR(50) NOT NULL,
  `datepost` VARCHAR(50) NOT NULL,
  `datestart` DATE NOT NULL,
  `dateend` DATE NOT NULL,
  `numberallowed` INT NOT NULL,
  `venue` INT NOT NULL,
  `description` VARCHAR(250) NOT NULL,
  `image` VARCHAR(50) NOT NULL,
  `location_image` VARCHAR(50) NOT NULL,
  `video` VARCHAR(50) NOT NULL,
  `location_video` VARCHAR(50) NOT NULL,
  `time` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idmuseai`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `venue_fk_idx` (`venue` ASC));


INSERT INTO `museai`(
`idmuseai`, 
`name`, 
`artist`, 
`year`,
`datepost`, 
`datestart`, 
`dateend`, 
`numberallowed`, 
`venue`, 
`description`, 
`image`, 
`location_image`, 
`video`, 
`location_video`,
`time`
) 
VALUES(
1, 
'The "Yesterday"', 
'izz segun', 
'1971',
'2021-10-29', 
'2021-10-29', 
'2021-10-29', 
1, 
1, 
'This is just test',
'yesterday_OLD.mp4', 
'videos/yesterday_OLD.mp4', 
'yesterday_OLD.mp4', 
'videos/yesterday_OLD.mp4',
'05:24:00pm'
);
-- -----------------------------------------------------
-- Table `session`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `session` (
  `idsession` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `numberallowed` INT NOT NULL,
  `museai` INT NOT NULL,
  `startdate` DATETIME NOT NULL,
  `enddate` DATETIME NOT NULL,
  PRIMARY KEY (`idsession`));


-- -----------------------------------------------------
-- Table `attendee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attendee` (
  `idattendee` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `role` INT NULL,
  PRIMARY KEY (`idattendee`),
  INDEX `role_idx` (`role` ASC));


-- -----------------------------------------------------
-- Table `manager_museai`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `manager_museai` (
  `museai` INT NOT NULL,
  `manager` INT NOT NULL,
	PRIMARY KEY (`museai`, `manager`));

-- -----------------------------------------------------
-- Table `attendee_museai`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attendee_museai` (
  `museai` INT NOT NULL,
  `attendee` INT NOT NULL,
  `paid` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`museai`, `attendee`));


-- -----------------------------------------------------
-- Table `attendee_session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attendee_session` (
  `session` INT NOT NULL,
  `attendee` INT NOT NULL,
  PRIMARY KEY (`session`, `attendee`));

-- -----------------------------------------------------
-- Table `role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `role` (
  `idrole` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idrole`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));

INSERT INTO `role` (`name`) values ('admin'),('museai manager'),('attendee');