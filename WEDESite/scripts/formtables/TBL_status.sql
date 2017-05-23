create table IF NOT EXISTS status(value_id smallint not null primary key, property varchar(80) not null);

--Inserts
/*should probably change to better fit a college university atmosphere, must drop all profiles and 
users first and then drop table table and reinsert before running userGenerator*/

INSERT INTO status VALUES(0, 'Relationship Status:');
INSERT INTO status VALUES(1, 'Single');
INSERT INTO status VALUES(2, 'Seperated'); /*In a Relationship*/
INSERT INTO status VALUES(4, 'Recently Divorced'); /*Unhappy in a Relationship*/
INSERT INTO status VALUES(8, 'Recently Widowed');
INSERT INTO status VALUES(16, 'Unhappily Married'); 