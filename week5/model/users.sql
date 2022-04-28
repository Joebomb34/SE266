CREATE TABLE  IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
  userName NVARCHAR(16) NOT NULL,
  userPassword NVARCHAR(255) NULL,
  userSalt NVARCHAR(32) NOT NULL);

  INSERT into users SET userName = "donald", userPassword = sha1(CONCAT("school-salt","duck")), userSalt = "school-salt";