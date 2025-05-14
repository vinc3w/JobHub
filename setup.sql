CREATE DATABASE jobhub;

USE jobhub;

CREATE TABLE user (
	id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female') DEFAULT 'Male',
    date_of_birth DATE,
    profile_picture VARCHAR(255),  
    preferred_position VARCHAR(35),    
    preferred_location VARCHAR(255),    
    preferred_work_type ENUM('Full Time', 'Part Time', 'Contract', 'Casual/Vacation') DEFAULT 'Full Time',
    about VARCHAR(255),    
    ability VARCHAR(255),    
    knowledge VARCHAR(255),    
    current_educational_level ENUM('High School Graduate', 'College Graduate', 'University Graduate', 'Master''s', 'Doctorate', 'PhD') DEFAULT 'High School Graduate',
    educational_background VARCHAR(255),    
    more_info VARCHAR(255),    
    is_admin BOOLEAN NOT NULL DEFAULT 0,
    date_joined DATETIME NOT NULL
);

CREATE TABLE user_token (
    user_id INT NOT NULL,
    token CHAR(40) NOT NULL,
    expiry DATETIME,
    FOREIGN KEY (user_id) REFERENCES user(id)
    ON DELETE CASCADE
);

CREATE TABLE password_reset_code (
    email VARCHAR(255) NOT NULL,
    code CHAR(6) NOT NULL,
    expiry DATETIME
);

CREATE TABLE user_skill (
	id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    skill VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
    ON DELETE CASCADE
);

CREATE TABLE notification (
	id INT PRIMARY KEY AUTO_INCREMENT,
    to_user INT NOT NULL,
    from_user INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    description VARCHAR(255),    
    time_created DATETIME NOT NULL,
    FOREIGN KEY (to_user) REFERENCES user(id)
    ON DELETE CASCADE,
    FOREIGN KEY (from_user) REFERENCES user(id)
    ON DELETE CASCADE
);
