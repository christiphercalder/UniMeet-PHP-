create table IF NOT EXISTS smoker(value_id smallint not null primary key, property varchar(20) not null);

--Inserts

insert into smoker values(0, 'Do You Smoke:');
insert into smoker values(1, 'Yes');
insert into smoker values(2, 'No');
insert into smoker values(4, 'Casual');