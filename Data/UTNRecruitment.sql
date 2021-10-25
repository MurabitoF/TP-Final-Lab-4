CREATE DATABASE IF NOT EXISTS `UTNRecruitment` DEFAULT CHARACTER SET utf8 ;

use `UTNRecruitment`;

CREATE TABLE `Company`(
`idCompany` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(45) NOT NULL UNIQUE,
`street` VARCHAR(45) NOT NULL,
`streetAddress` INT NOT NULL,
`active` BOOLEAN DEFAULT TRUE,
`postalCode` INT NOT NULL,
`idJobPosition` INT NOT NULL,
PRIMARY KEY (`idCompany`),
CONSTRAINT `fk_Company_postalCode`
FOREIGN KEY (`postalCode`)
REFERENCES `City`(`postalCode`)
ON UPDATE CASCADE,
CONSTRAINT `fk_Company_idJobPosition`
FOREIGN KEY (`idJobPosition`)
REFERENCES `JobPosition`(`idJobPosition`)
ON UPDATE CASCADE
);

CREATE TABLE `City`(
`postalCode` INT NOT NULL,
`name` VARCHAR(45) NOT NULL,
`province` VARCHAR(45) NOT NULL,
PRIMARY KEY (`postalCode`)
);

CREATE TABLE `JobPosition`(
`idJobPosition` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(45) NOT NULL,
`idCareer` INT NOT NULL,
PRIMARY KEY (`idJobPosition`),
CONSTRAINT `fk_jobPosition_idCareer`
FOREIGN KEY (`idCareer`)
REFERENCES `Career`(`idCareer`)
);

CREATE TABLE `Career`(
`idCareer` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(45) NOT NULL,
PRIMARY KEY(`idCareer`)
);

CREATE TABLE `User`(
`idUser` INT NOT NULL AUTO_INCREMENT,
`userName` VARCHAR(45) NOT NULL UNIQUE,
`password` VARCHAR(45) NOT NULL,
`role` VARCHAR(45) NOT NULL,
`active` BOOLEAN DEFAULT TRUE,
`idCareer` INT NOT NULL,
PRIMARY KEY (`idUser`),
CONSTRAINT `fk_idCareer`
FOREIGN KEY (`idCareer`)
REFERENCES `Career`(`idCareer`)
ON UPDATE CASCADE
);

CREATE TABLE `JobOffers`(
`idJobOffer` INT NOT NULL AUTO_INCREMENT,
`jobPossition` VARCHAR(45) NOT NULL,
`description` VARCHAR(200),
`income` FLOAT NOT NULL,
`workload` VARCHAR(10) NOT NULL,
`requirements` VARCHAR(45),
`postDate` DATE NOT NULL,
`expireDate` DATE NOT NULL,
`active` BOOLEAN DEFAULT TRUE,
`postalCode` INT NOT NULL,
`idJobPosition` INT NOT NULL,
`idCareer` INT NOT NULL,
PRIMARY KEY (`idJobOffer`),
CONSTRAINT `fk_JobOffer_postalCode`
FOREIGN KEY (`postalCode`)
REFERENCES `City`(`postalCode`)
ON UPDATE CASCADE,
CONSTRAINT `fk_JobOffer_idJobPosition`
FOREIGN KEY (`idJobPosition`)
REFERENCES `JobPosition`(`idJobPosition`)
ON UPDATE CASCADE,
CONSTRAINT `fk_JobOffer_idCareer`
FOREIGN KEY (`idCareer`)
REFERENCES `Career`(`idCareer`)
ON UPDATE CASCADE
);

CREATE TABLE `Company_Has_JobOffer`(
`idCompany_Has_JobOffer` INT NOT NULL AUTO_INCREMENT,
`idJobOffer` INT NOT NULL,
`idCompany` INT NOT NULL,
PRIMARY KEY (`idCompany_Has_JobOffer`),
CONSTRAINT `fk_idJobOffer`
FOREIGN KEY (`idJobOffer`)
REFERENCES `JobOffers`(`idJobOffer`)
ON UPDATE CASCADE,
CONSTRAINT `fk_idCompany`
FOREIGN KEY (`idCompany`)
REFERENCES `Company`(`idCompany`)
ON UPDATE CASCADE
);

CREATE TABLE `User_Has_JobOffer`(
`idUser_Has_JobOffer` INT NOT NULL AUTO_INCREMENT,
`date` DATE NOT NULL,
`idJobOffer` INT NOT NULL,
`idUser` INT NOT NULL,
PRIMARY KEY (`idUser_Has_JobOffer`),
CONSTRAINT `fk_UserhasJobOffer_idJobOffer`
FOREIGN KEY (`idJobOffer`)
REFERENCES `JobOffers`(`idJobOffer`)
ON UPDATE CASCADE,
CONSTRAINT `fk_idUser`
FOREIGN KEY (`idUser`)
REFERENCES `User`(`idUser`)
ON UPDATE CASCADE
);