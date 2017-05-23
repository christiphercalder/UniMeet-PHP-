-- File: TBL_ethnicity.sql
-- Author: Chris Calder
-- Date: 05/10/2015
-- Desc: SQL file to create ethnic origin property/value table

create table IF NOT EXISTS ethnicity(value_id smallint not null primary key, property varchar(80) not null);
 
 --Inserts

insert into ethnicity values(0, 'Ethnicity:');
insert into ethnicity values(1, 'Caucasion');
insert into ethnicity values(2, 'Latin American');
insert into ethnicity values(4, 'Native American');
insert into ethnicity values(8, 'Asian');
insert into ethnicity values(16, 'East Indian');
insert into ethnicity values(32, 'African American');