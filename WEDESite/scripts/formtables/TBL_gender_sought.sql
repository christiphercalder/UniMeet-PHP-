-- File: TBL_gender_sought.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create gender type property/value table

CREATE TABLE IF NOT EXISTS gender_sought(value_id SMALLINT NOT NULL PRIMARY KEY, property VARCHAR(25) NOT NULL);

-- INSERTS

INSERT INTO gender_sought VALUES(0, 'Gender Seeking:');
INSERT INTO gender_sought VALUES(1, 'Male');
INSERT INTO gender_sought VALUES(2, 'Female');
