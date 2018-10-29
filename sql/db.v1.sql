CREATE DATABASE IF NOT EXISTS task2;
USE task2;

CREATE TABLE `participant`(
    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(30) NOT NULL,
    `lastname` VARCHAR(30) NOT NULL,
    `birthdate` DATE NOT NULL,
    `reportsubject` VARCHAR(255) NOT NULL,
    `country` VARCHAR(30) NOT NULL,
    `phone` VARCHAR(30) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `company` VARCHAR(30),
    `position` VARCHAR(30),
    `aboutme` VARCHAR(255),
    `photo` VARCHAR(255)
);

INSERT INTO `participant` (firstname, lastname, birthdate, reportsubject, country, phone, email, company, position, aboutme, photo) VALUES
  ("ivan", "ivanov","1997-12-31","reportsubject","Ukraine","+1 (555) 555-5555","ivanov@gmail.com","company","student","I am student","/uploads/1.jpg");

SELECT photo, firstname, lastname, reportsubject, email FROM `participant`;

UPDATE `participant`
SET company = 'company', position= 'position', aboutme = 'aboutme', photo = ''
WHERE id = 1;

