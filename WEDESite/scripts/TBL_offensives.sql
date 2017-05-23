create table IF NOT EXISTS offensives();
ALTER TABLE offensives
ADD offensive_user_id VARCHAR(20) NOT NULL references users,
ADD reporting_user_id VARCHAR(20) NOT NULL references users,
ADD report_date date NOT NULL,
ADD status VARCHAR(25) NOT NULL;
