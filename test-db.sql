-- Create the database only if it does not exist
CREATE DATABASE IF NOT EXISTS korisnici;

-- Switch to the newly created database
USE korisnici;

-- Create a table
CREATE TABLE korisnici (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           name VARCHAR(50),
                           email VARCHAR(100),
                           password VARCHAR(400),
                           pfp_loc TEXT
);

CREATE TABLE posts (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       fk_id INT NOT NULL,
                       title VARCHAR(50),
                       text VARCHAR(500)
);
CREATE TABLE comments (
    id_com INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    creator_id INT NOT NULL,
    post_id INT NOT NULL
        );
CREATE TABLE likes(
    id_like INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_post INT NOT NULL
);
CREATE TABLE friends(
    id_friend INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_wannabe_friend_with INT NOT NULL,
    status INT NOT NULL
);
-- Insert some initial data
