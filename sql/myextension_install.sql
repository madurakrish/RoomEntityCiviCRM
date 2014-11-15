CREATE TABLE IF NOT EXISTS civicrm_room (
		id INT(6) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		room_label VARCHAR(30) NOT NULL,
		room_number VARCHAR(30),
		room_floor VARCHAR(50) ,
		room_ext VARCHAR(50)
		);