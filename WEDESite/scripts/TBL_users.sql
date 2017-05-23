CREATE TABLE IF NOT EXISTS users();
ALTER TABLE users 
ADD user_id VARCHAR(20) NOT NULL PRIMARY KEY, 
ADD password VARCHAR(32) NOT NULL,
ADD user_type CHAR(1) NOT NULL,
ADD email_address VARCHAR(256) NOT NULL,
ADD first_name VARCHAR(128) NOT NULL,
ADD last_name VARCHAR(128) NOT NULL,
ADD birth_date date,
ADD enroll_date date,
ADD last_access date;

INSERT INTO users VALUES(
	'homer12', 
	'5f4dcc3b5aa765d61d8327deb882cf99', 
	'a',
	'homer12@gmail.com', 
	'Homer', 
	'Simpson', 
	'1965/03/23',
	'2015/09/20');
INSERT INTO users VALUES(
	'flanders99', 
	'5f4dcc3b5aa765d61d8327deb882cf99', 
	'a', 
	'flanders99@gmail.com', 
	'Ned', 
	'Flanders', 
	'1967/05/28', 
	'2015/09/20');
