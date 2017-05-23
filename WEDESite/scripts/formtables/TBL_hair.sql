-- File: TBL_hair.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create hair colour property/value table

create table IF NOT EXISTS hair(value_id smallint not null primary key, property varchar(50) not null);

--INSERTS
insert into hair(hair_id, colour) values(0, 'Hair Colour:');
insert into hair(hair_id, colour) values(1, 'Black');
insert into hair(hair_id, colour) values(2, 'Brunette');
insert into hair(hair_id, colour) values(4, 'Blonde');
insert into hair(hair_id, colour) values(8, 'Auburn');
insert into hair(hair_id, colour) values(16, 'Chestnut');
insert into hair(hair_id, colour) values(32, 'Red');
insert into hair(hair_id, colour) values(64, 'Gray/White');
