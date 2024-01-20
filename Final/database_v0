--------original version
DROP DATABASE IF EXISTS VisualArtShowcaseDB_test;

CREATE DATABASE VisualArtShowcaseDB_test;

USE VisualArtShowcaseDB_test;

CREATE TABLE Roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(10) NOT NULL 
);

INSERT INTO Roles (role_name) VALUES
('user'),
('artist'),
('admin');
-- 

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(60) NOT NULL,
    profile_picture VARCHAR(255),
    name VARCHAR(255),
    bio TEXT,
    location VARCHAR(255),
    role_id INT NOT NULL DEFAULT 1 --role_id user
    FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE RESTRICT --not possible, we're using the role
);

CREATE TABLE Artists ( 
    artist_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT, --not all artists are users
    artist_name VARCHAR(255) NOT NULL,
    bio TEXT,
    website VARCHAR(255),
    social_media VARCHAR(255),
    role_id INT NOT NULL DEFAULT 2, --role_id artist
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE RESTRICT, --if there's an artist with that user, you should erase the artist first
    FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE RESTRICT --not possible, we're using the role
);

CREATE TABLE UserFollowsArtist ( --user_id might follow his/her artist_id, hence following himself/herself, restrict via php
    user_id INT,
    artist_id INT,
    follow_date DATE,
    PRIMARY KEY (user_id, artist_id), --in case of unfollow, we delete the row, we dont need to keep each follow data for now.. maybe when we scale
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE, --if user deleted, his/her followings are gone
    FOREIGN KEY (artist_id) REFERENCES Artists(artist_id) ON DELETE CASCADE, --if artist deleted, his/her followers are gone
);

CREATE TABLE Category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO Category (category_name) VALUES
('painting'),
('drawing'),
('sculpture'),
('illustration')
;

CREATE TABLE Artworks (
    artwork_id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT,
    title VARCHAR(255) NOT NULL,
    technical_sheet TEXT,
    image_url VARCHAR(255) NOT NULL,
    upload_date DATE NOT NULL,
    category_id INT,
    FOREIGN KEY (artist_id) REFERENCES Artists(artist_id) ON DELETE SET NULL, --if artist is deleted, his/her artwork remains
    FOREIGN KEY (category_id) REFERENCES Category(category_id) ON DELETE SET RESTRICT --category can't be deleted, we are using it in an artwork
);

CREATE TABLE Likes (
    user_id INT NOT NULL,
    artwork_id INT NOT NULL,
    like_date DATETIME NOT NULL,
    PRIMARY KEY (user_id, artwork_id), --in case of unlike, deleting the row is enough, again, we don't need this data now
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE, --if user is deleted, his/her likes are gone
    FOREIGN KEY (artwork_id) REFERENCES Artworks(artwork_id) ON DELETE CASCADE --if artwork is deleted, its likes are gone
);

CREATE TABLE Comments (
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    artwork_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE, --if user is deleted, his/her comments are gone
    FOREIGN KEY (artwork_id) REFERENCES Artworks(artwork_id) ON DELETE CASCADE --if artwork is deleted, its comments are gone
);

CREATE TABLE WeeklyShowcase (
    weekly_showcase_id INT AUTO_INCREMENT PRIMARY KEY,
    year INT NOT NULL,
    --formatted_id VARCHAR(15) AS (CONCAT(year, '-', weekly_showcase_id)) STORED, --gone for good, php will do it
    week_start_date DATE NOT NULL,
    week_end_date DATE NOT NULL,
    featured_artist_id INT,
    FOREIGN KEY (featured_artist_id) REFERENCES Artists(artist_id) ON DELETE SET NULL --if artist is deleted, artist_id will be null
);

CREATE TABLE ShowcaseArtworks (
    weekly_showcase_id INT,
    artwork_id INT,
    showcase_day INT, -- represents the day of the week (1 to 7)
    PRIMARY KEY (weekly_showcase_id, artwork_id),
    FOREIGN KEY (weekly_showcase_id) REFERENCES WeeklyShowcase(weekly_showcase_id) ON DELETE CASCADE, --if weekly showcase is deleted, all the artwork of the week is gone
    FOREIGN KEY (artwork_id) REFERENCES Artworks(artwork_id) ON DELETE RESTRICT --artwork can't be deleted, we are using it in a week
);