CREATE TABLE  IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
  userName VARCHAR(16) NOT NULL,
  userPassword VARCHAR(255) NULL,
  userSalt VARCHAR(32) NOT NULL);

  INSERT INTO users (userName, userPassword, userSalt) VALUES ('donald', 'duck', 'school-salt');