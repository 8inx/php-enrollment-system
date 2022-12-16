USE `:database`;

CREATE TABLE `courses`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `description` VARCHAR(255) NOT NULL,
    `status` VARCHAR(15) DEFAULT('available')
);

CREATE TABLE `subjects` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `description` VARCHAR(255) NOT NULL,
    `units` INT NOT NULL DEFAULT(1)
);

CREATE TABLE `sections` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `maxStudents` INT DEFAULT(30)
);

CREATE TABLE `students` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    `firstName` VARCHAR(100) NOT NULL,
    `lastName` VARCHAR(100) NOT NULL,
    `email` VARCHAR(50) NOT NULL UNIQUE,
    `gender` VARCHAR(15),
    `courseId` INT,
    `dateCreated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`courseId`) REFERENCES courses(`id`)
    ON DELETE SET NULL
);



CREATE TABLE `sectionSubjects`(
    `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `sectionId` INT NOT NULL,
    `subjectId` INT NOT NULL,
    `days` VARCHAR(20),
    `timeIn` TIME,
    `timeOut` TIME,
    `room` VARCHAR(100),
    
    FOREIGN KEY (`sectionId`) REFERENCES sections(`id`)
    ON DELETE CASCADE,
    FOREIGN KEY (`subjectId`) REFERENCES subjects(`id`)
    ON DELETE CASCADE
);

CREATE TABLE `enrollments` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `studentId` INT,
    `sectionId` INT,
    `semester` INT,
    `year` INT,
    `status` VARCHAR(15) DEFAULT('ongoing'),
    `dateEnrolled` DATETIME,
    `dateCreated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (`studentId`) REFERENCES students(`id`)
    ON DELETE CASCADE,
    FOREIGN KEY (`sectionId`) REFERENCES sections(`id`)
    ON DELETE CASCADE
);