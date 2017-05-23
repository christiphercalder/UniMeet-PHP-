-- File: TBL_languages.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create spoken language property/value table

CREATE TABLE IF NOT EXISTS languages(value_id smallint not null primary key, property varchar(50) not null);

--Inserts

INSERT INTO languages VALUES(0, 'Second Language:');
INSERT INTO languages VALUES(1, 'English');
INSERT INTO languages VALUES(2, 'French');
INSERT INTO languages VALUES(4, 'Spanish');
INSERT INTO languages VALUES(8, 'Chinese');
INSERT INTO languages VALUES(16, 'Hindi');
INSERT INTO languages VALUES(32, 'Arabic');
INSERT INTO languages VALUES(64, 'Portugese');
INSERT INTO languages VALUES(128, 'Russian');
INSERT INTO languages VALUES(256, 'Bengali');
INSERT INTO languages VALUES(512, 'Japanese');
INSERT INTO languages VALUES(1024, 'Native American');