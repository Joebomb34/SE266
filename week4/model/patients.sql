/*
	Edit - Preferences - SQL Editor - Uncheck Safe Updates
        Query - Reconnect  to Server
*/
CREATE TABLE IF NOT EXISTS patients (
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        patientFirstName VARCHAR(50) DEFAULT NULL,
        patientLastName VARCHAR(50) DEFAULT NULL,
        patientMarried TINYINT(1),
        patientBirthDate DATE
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) VALUES ('Ashley', 'Shaw', '0', '01/23/1996');
INSERT INTO  patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) VALUES ('John', 'Aaron', '1', '06/02/1980');
INSERT INTO  patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) VALUES ('Rick', 'Snachez', '0', '05/23/1946');
INSERT INTO  patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) VALUES ('Alex', 'Smith', '1', '12/04/1954');
INSERT INTO  patients (patientFirstName, patientLastName, patientMarried, patientBirthDate) VALUES ('Rachel', 'Rodriguez', '1', '03/12/1962');