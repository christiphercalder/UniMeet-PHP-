-- File: TBL_cities.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create Cities property/value table

create table IF NOT EXISTS cities(value_id int NOT null primary key, property Varchar(50) not null);

--Inserts

insert into cities values(0, 'City:');
insert into cities values(1, 'Whitby');
insert into cities values(2, 'Ajax');
insert into cities values(4, 'Scarborough');
insert into cities values(8, 'Mississauga');
insert into cities values(16, 'Oshawa');
insert into cities values(32, 'Pickering');
insert into cities values(64, 'Bowmanville');
insert into cities values(128, 'Port Perry');
insert into cities values(256, 'Markham');
insert into cities values(512, 'Brampton');
insert into cities values(1024, 'Etobicoke');
insert into cities values(2048, 'Brooklin');
insert into cities values(4096, 'Caledon');
insert into cities values(8192, 'York');
insert into cities values(16384, 'Vaughn');
insert into cities values(32768, 'Richmond Hill');
insert into cities values(65536, 'Uxbridge');
insert into cities values(131072, 'Stouffville');
insert into cities values(262144, 'Toronto');
