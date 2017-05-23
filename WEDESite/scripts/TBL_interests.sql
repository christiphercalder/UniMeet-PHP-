create table IF NOT EXISTS interests();

ALTER TABLE interests
ADD user_id VARCHAR(20) NOT NULL references users,
ADD profile_of_interest VARCHAR(20) NOT NULL references users,
ADD PRIMARY KEY(user_id, profile_of_interest);