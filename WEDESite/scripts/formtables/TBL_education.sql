-- File: TBL_education.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create an education level property/value table

create table IF NOT EXISTS education(value_id smallint not null primary key, property varchar(80) not null);

--Inserts

INSERT INTO education VALUES(0, 'Highest Level of Education Reached:');
INSERT INTO education VALUES(1, 'High School');
INSERT INTO education VALUES(2, 'Some Post-Secondary');
INSERT INTO education VALUES(4, 'Post-Secondary Certificate');
INSERT INTO education VALUES(8, 'Post-Secondary Bachelors');
INSERT INTO education VALUES(16, 'Post-Secondary Masters');
INSERT INTO education VALUES(32, 'Mature Student Status');