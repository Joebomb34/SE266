--creating a new table named schools--

CREATE TABLE IF NOT EXISTS schools (
id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
        schoolName NVARCHAR(200) DEFAULT NULL,
        schoolCity NVARCHAR(200) DEFAULT NULL,
        schoolState NVARCHAR(200) DEFAULT NULL
        
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
