USE templetracker;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS visits;
DROP TABLE IF EXISTS user_to_visit;
DROP TABLE IF EXISTS user_to_group;


CREATE TABLE IF NOT EXISTS users(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(32) NOT NULL UNIQUE,
	pass VARCHAR(255) NOT NULL,
	CONSTRAINT unique_username_constraint UNIQUE(username)
);

CREATE TABLE IF NOT EXISTS groups(
    id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	group_admin INT UNSIGNED NOT NULL, 
	start_date VARCHAR(32) NOT NULL,
	end_date VARCHAR(32),
	CONSTRAINT admin_to_userID_fk FOREIGN KEY (group_admin) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS visits(    
	id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	contributor INT UNSIGNED NOT NULL,
	ordinance VARCHAR(32) NOT NULL,
	visit_date VARCHAR(32) NOT NULL,
	quantity INT UNSIGNED NOT NULL,
	note TEXT,
	CONSTRAINT visit_contributor FOREIGN KEY (contributor) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS user_to_visit(
	user_id int UNSIGNED NOT NULL,
	visit_id int UNSIGNED NOT NULL,
	CONSTRAINT u2v_userID_fk FOREIGN KEY (user_id) REFERENCES users(id),
	CONSTRAINT u2v_visitID_fk FOREIGN KEY (visit_id) REFERENCES visits(id)
);

CREATE TABLE IF NOT EXISTS user_to_group(
	user_id int UNSIGNED NOT NULL,
	group_id int UNSIGNED NOT NULL,
	CONSTRAINT u2g_userID_fk FOREIGN KEY (user_id) REFERENCES users(id),
	CONSTRAINT u2g_groupID_fk FOREIGN KEY (group_id) REFERENCES groups(id),
	CONSTRAINT no_duplicate_members_constraint UNIQUE (user_id, group_id)
);