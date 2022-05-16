/*
	Edit - Preferences - SQL Editor - Uncheck Safe Updates
        Query - Reconnect  to Server
*/
CREATE TABLE IF NOT EXISTS patients (
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        carMake VARCHAR(50) DEFAULT NULL,
        carModel VARCHAR(50) DEFAULT NULL,
        carPurchase DATE
        
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO cars (carMake, carModel, carPurchase) VALUES ('Honda', 'Civic', '2014-03-02');
INSERT INTO  cars (carMake, carModel, carPurchase) VALUES ('Volkswagen', 'Golf', '2019-04-23');
INSERT INTO  cars (carMake, carModel, carPurchase) VALUES ('Toyota', 'Camery', '1996-05-23');
INSERT INTO  cars (carMake, carModel, carPurchase) VALUES ('Subaru', 'Impreza', '2004-12-04');
INSERT INTO  cars (carMake, carModel, carPurchase) VALUES ('Ford', 'Focus', '2021-03-12');