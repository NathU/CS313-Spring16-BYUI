USE templeTracker;

DROP TABLE IF EXISTS user_table;
DROP TABLE IF EXISTS group_table;
DROP TABLE IF EXISTS visit_table;



CREATE TABLE IF NOT EXISTS user_table(
    user_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(32) NOT NULL UNIQUE,
	pass VARCHAR(16) NOT NULL,
	settings VARCHAR(128),
	user_info VARCHAR(128),
	group_list TEXT,
	CONSTRAINT email_must_be_unique UNIQUE(email)
);

CREATE TABLE IF NOT EXISTS group_table(
    group_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	administrator INT UNSIGNED NOT NULL, 
	member_list TEXT,
	invite_list TEXT,
	create_date DATETIME NOT NULL,
	end_date DATETIME,
	CONSTRAINT admin_to_userID_constraint FOREIGN KEY (administrator) REFERENCES user_table(user_id)
);

CREATE TABLE IF NOT EXISTS visit_table(    
	visit_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	ordinance VARCHAR(2) NOT NULL,
	visit_date DATETIME NOT NULL,
	quantity INT UNSIGNED NOT NULL,
	note TEXT,
	contributor INT UNSIGNED NOT NULL,
	CONSTRAINT contributor_to_userID_constraint FOREIGN KEY (contributor) REFERENCES user_table(user_id)
);
