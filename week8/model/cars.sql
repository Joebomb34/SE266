/*
	Edit - Preferences - SQL Editor - Uncheck Safe Updates
        Query - Reconnect  to Server
*/
CREATE TABLE IF NOT EXISTS cars (
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        carYear INT(4) DEFAULT NULL,
        carMake VARCHAR(50) DEFAULT NULL,
        carModel VARCHAR(50) DEFAULT NULL,
        carTrans VARCHAR(50) DEFAULT NULL,
        carColor VARCHAR(50) DEFAULT NULL,
        carPurchase DATE
        
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO cars (carYear, carMake, carModel, carTrans, carColor, carPurchase) VALUES ('2013', 'Honda', 'Civic', 'Automatic', 'Silver', '2014-03-02');
INSERT INTO  cars (carYear, carMake, carModel, carTrans, carColor, carPurchase) VALUES ('2019', 'Volkswagen', 'Golf', 'Manual', 'Black','2019-04-23');
INSERT INTO  cars (carYear, carMake, carModel, carTrans, carColor, carPurchase) VALUES ('1994', 'Toyota', 'Camery', 'Automatic', 'Green', '1996-05-23');
INSERT INTO  cars (carYear, carMake, carModel, carTrans, carColor, carPurchase) VALUES ('2001', 'Subaru', 'Impreza', 'Manual', 'Blue', '2004-12-04');
INSERT INTO  cars (carYear, carMake, carModel, carTrans, carColor, carPurchase) VALUES ('2021', 'Ford', 'Focus', 'Electric', 'White', '2021-03-12');