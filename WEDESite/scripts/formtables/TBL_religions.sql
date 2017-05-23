create table IF NOT EXISTS religions(value_id smallint not null primary key, property varchar(50) not null);

--Inserts

INSERT INTO religions VALUES(0, 'Religion:');
INSERT INTO religions VALUES(1, 'Catholic');
INSERT INTO religions VALUES(2, 'Buhddism');
INSERT INTO religions VALUES(4, 'Judaism');
INSERT INTO religions VALUES(8, 'Islam');
INSERT INTO religions VALUES(16, 'Atheist');
INSERT INTO religions VALUES(32, 'Not Sure');
INSERT INTO religions VALUES(64, 'Rather Not Say');
INSERT INTO religions VALUES(128, 'Hinduism');