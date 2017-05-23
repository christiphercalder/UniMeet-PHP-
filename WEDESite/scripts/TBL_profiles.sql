﻿create table IF NOT EXISTS profiles();
ALTER TABLE profiles 
ADD user_id VARCHAR(20) REFERENCES users, 
ADD gender_id SMALLINT NOT NULL, 
ADD gender_sought SMALLINT NOT NULL, 
ADD city_id INT NOT NULL, 
ADD school_id INT NOT NULL,
ADD study_major VARCHAR(150) NOT NULL,
ADD images SMALLINT NOT NULL DEFAULT 0, 
ADD profile_image SMALLINT NOT NULL DEFAULT 0,
ADD head_line VARCHAR(100) NOT NULL, 
ADD self_description VARCHAR(1000) NOT NULL,
ADD match_description VARCHAR(1000) NOT NULL,
ADD hair_id SMALLINT NOT NULL,
ADD body_id SMALLINT NOT NULL,
ADD smoker_id SMALLINT NOT NULL,
ADD ethnic_id SMALLINT NOT NULL,
ADD language_id SMALLINT NOT NULL,
ADD status_id SMALLINT NOT NULL,
ADD seeking_id SMALLINT NOT NULL,
ADD religion_id SMALLINT NOT NULL,
ADD education_id SMALLINT NOT NULL;