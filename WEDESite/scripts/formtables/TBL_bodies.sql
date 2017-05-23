-- File: bodies.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create bodytype property/value table

create table IF NOT EXISTS bodies(value_id smallint not null primary key, property varchar(25) not null);

--Inserts

INSERT INTO bodies VALUES(0, 'Body Type:');
INSERT INTO bodies VALUES(1, 'Thin');
INSERT INTO bodies VALUES(2, 'Toned');
INSERT INTO bodies VALUES(4, 'Average');
INSERT INTO bodies VALUES(8, 'Athletic');
INSERT INTO bodies VALUES(16, 'Muscular');
INSERT INTO bodies VALUES(32, 'Curvy');
INSERT INTO bodies VALUES(64, 'Full Figured');
INSERT INTO bodies VALUES(128, 'Rather Not Say');