-- File: TBL_genders.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create gender type property/value table

CREATE TABLE IF NOT EXISTS genders(value_id SMALLINT NOT NULL PRIMARY KEY, property VARCHAR(25) NOT NULL);

-- INSERTS

INSERT INTO genders VALUES(0, 'Gender:');
INSERT INTO genders VALUES(1, 'Male');
INSERT INTO genders VALUES(2, 'Female');
