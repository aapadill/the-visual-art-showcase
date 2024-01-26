-------MySQL version with no comments and no errors
DROP DATABASE IF EXISTS VisualArtShowcaseDB;

CREATE DATABASE VisualArtShowcaseDB;

USE VisualArtShowcaseDB;

CREATE TABLE Roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(10) NOT NULL 
);

INSERT INTO Roles (role_name) VALUES ('user'), ('artist'), ('admin');

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(60) NOT NULL,
    profile_picture VARCHAR(255),
    name VARCHAR(255),
    bio TEXT,
    location VARCHAR(255),
    role_id INT NOT NULL DEFAULT 1,
    is_subscribed BOOLEAN NOT NULL DEFAULT FALSE;
    FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE RESTRICT
);

CREATE TABLE Artists (
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    artist_name VARCHAR(255) NOT NULL,
    bio TEXT,
    website VARCHAR(255),
    social_media VARCHAR(255),
    role_id INT NOT NULL DEFAULT 2,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE RESTRICT,
    FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE RESTRICT
);

CREATE TABLE UserFollowsArtist (
    user_id INT,
    artist_id INT,
    follow_date DATE,
    PRIMARY KEY (user_id, artist_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES Artists(artist_id) ON DELETE CASCADE
);

CREATE TABLE Category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO Category (category_name) VALUES ('painting'), ('drawing'), ('sculpture'), ('illustration');

CREATE TABLE Artworks (
    artwork_id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT,
    title VARCHAR(255) NOT NULL,
    technical_sheet TEXT,
    image_url VARCHAR(255) NOT NULL,
    upload_date DATE NOT NULL,
    category_id INT,
    FOREIGN KEY (artist_id) REFERENCES Artists(artist_id) ON DELETE SET NULL,
    FOREIGN KEY (category_id) REFERENCES Category(category_id) ON DELETE RESTRICT
);

CREATE TABLE Likes (
    user_id INT NOT NULL,
    artwork_id INT NOT NULL,
    like_date DATETIME NOT NULL,
    PRIMARY KEY (user_id, artwork_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (artwork_id) REFERENCES Artworks(artwork_id) ON DELETE CASCADE
);

CREATE TABLE Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    artwork_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (artwork_id) REFERENCES Artworks(artwork_id) ON DELETE CASCADE
);

CREATE TABLE WeeklyShowcase (
    weekly_showcase_id INT AUTO_INCREMENT PRIMARY KEY,
    week_start_date DATE NOT NULL,
    week_end_date DATE NOT NULL,
    featured_artist_id INT,
    FOREIGN KEY (featured_artist_id) REFERENCES Artists(artist_id) ON DELETE SET NULL
);

CREATE TABLE ShowcaseArtworks (
    weekly_showcase_id INT,
    artwork_id INT,
    showcase_day INT,
    PRIMARY KEY (weekly_showcase_id, artwork_id),
    FOREIGN KEY (weekly_showcase_id) REFERENCES WeeklyShowcase(weekly_showcase_id) ON DELETE CASCADE,
    FOREIGN KEY (artwork_id) REFERENCES Artworks(artwork_id) ON DELETE RESTRICT
);

-------future tables
--quitar is subscribed
CREATE TABLE Subscriptions (
    subscription_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subscribed_date DATE NOT NULL,
    subscription_status BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);