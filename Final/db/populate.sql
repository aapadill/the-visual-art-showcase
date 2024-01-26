INSERT INTO Users (username, email, password, profile_picture, name, bio, location, role_id) VALUES 
    ('alexsmith', 'alexsmith@example.com', 'pass1234', 'images/users/alex_pic.jpg', 'Alex Smith', 'Artist and designer from New York.', 'New York', 1),
    ('emilyjones', 'emilyjones@example.com', 'pass2345', 'images/users/emily_pic.jpg', 'Emily Jones', 'Freelance illustrator based in San Francisco.', 'San Francisco', 1),
    ('davidjohnson', 'davidjohnson@example.com', 'pass3456', 'images/users/david_pic.jpg', 'David Johnson', 'Aspiring digital artist and animator.', 'Los Angeles', 1),
    ('sarahbrown', 'sarahbrown@example.com', 'pass4567', 'images/users/sarah_pic.jpg', 'Sarah Brown', 'Professional photographer and visual artist.', 'Chicago', 1),
    ('michaellee', 'michaellee@example.com', 'pass5678', 'images/users/michael_pic.jpg', 'Michael Lee', 'Graphic designer with a passion for street art.', 'Houston', 1),
    ('lindawilliams', 'lindawilliams@example.com', 'pass6789', 'images/users/linda_pic.jpg', 'Linda Williams', 'Abstract painter and art instructor.', 'Philadelphia', 1),
    ('chrisevans', 'chrisevans@example.com', 'pass7890', 'images/users/chris_pic.jpg', 'Chris Evans', 'Contemporary artist focusing on environmental themes.', 'Phoenix', 1),
    ('oliviawilson', 'oliviawilson@example.com', 'pass8901', 'images/users/olivia_pic.jpg', 'Olivia Wilson', 'Mixed media artist and freelance designer.', 'San Antonio', 1),
    ('jamesmoore', 'jamesmoore@example.com', 'pass9012', 'images/users/james_pic.jpg', 'James Moore', 'Landscape painter and art history enthusiast.', 'San Diego', 1),
    ('laurataylor', 'laurataylor@example.com', 'pass0123', 'images/users/laura_pic.jpg', 'Laura Taylor', 'Ceramic artist and pottery workshop instructor.', 'Dallas', 1);

INSERT INTO Artists (user_id, artist_name, bio, website, social_media, role_id) VALUES
    (1, 'Alex Smith', 'Talented artist specializing in abstract painting.', 'www.alexsmithart.com', 'www.instagram.com/alexsmithart/', 2),
    (2, 'Emily Jones', 'Award-winning illustrator known for vibrant and whimsical artwork.', 'www.emilyjonesillustrations.com', 'www.instagram.com/emilyillustrates/', 2),
    (3, 'Juan Gabriel', 'Somebody', 'www.davidjohnsonart.com', 'www.twitter.com/digitaldavid/', 2),
    (4, 'Leo Dicaprio', 'This is another artist', 'www.abc.com', 'www.instagram.com/abc/', 2),
    (5, 'Emily Jones', 'Cool, thanks', 'www.cde.com', 'www.instagram.com/cde/', 2),
    (6, 'David Johnson', 'Wow Im an artist', 'www.fgh.com', 'www.twitter.com/fgh/', 2);

INSERT INTO UserFollowsArtist (user_id, artist_id, follow_date) VALUES
    (1, 2, '2023-01-15'),
    (1, 3, '2023-02-20'),
    (1, 6, '2023-05-12'),
    (2, 1, '2023-01-20'),
    (2, 3, '2023-02-25'),
    (2, 4, '2023-03-15'),
    (2, 5, '2023-04-10'),
    (3, 1, '2023-02-02'),
    (3, 2, '2023-03-12'),
    (3, 4, '2023-04-08'),
    (3, 5, '2023-05-06'),
    (3, 6, '2023-06-21'),
    (4, 1, '2023-06-21'),
    (5, 1, '2023-06-21'),
    (6, 1, '2023-06-21');

INSERT INTO WeeklyShowcase (year, week_start_date, week_end_date, featured_artist_id) VALUES
(2023, '2023-01-01', '2023-01-07', 1),
(2023, '2023-01-08', '2023-01-14', 2),
(2023, '2023-01-15', '2023-01-21', 3),
(2023, '2023-01-22', '2023-01-28', 4),
(2023, '2023-01-29', '2023-02-04', 5),
(2023, '2023-02-05', '2023-02-11', 6),
(2023, '2023-02-12', '2023-02-18', 1),
(2023, '2023-02-19', '2023-02-25', 2),
(2023, '2023-02-26', '2023-03-04', 3),
(2023, '2023-03-05', '2023-03-11', 4);

INSERT INTO Artworks (artist_id, title, technical_sheet, image_url, upload_date, category_id) VALUES
(1, 'Abstract Sunrise', 'Oil on canvas, 40x60 inches', 'images/artworks/art1.jpg', '2023-01-10', 1),
(2, 'Urban Landscape', 'Acrylic, 36x48 inches', 'images/art2.jpg', '2023-01-15', 2),
(3, 'The Lonely Tree', 'Watercolor, 30x40 inches', 'images/art3.jpg', '2023-01-20', 3),
(4, 'Modern Life', 'Mixed media, 50x50 inches', 'images/art4.jpg', '2023-01-25', 4),
(5, 'Dream in Color', 'Digital art, high resolution', 'images/art5.jpg', '2023-01-30', 1),
(1, 'City at Night', 'Oil on canvas, 40x60 inches', 'images/art6.jpg', '2023-02-05', 2),
(2, 'Peaceful Countryside', 'Acrylic, 36x48 inches', 'images/art7.jpg', '2023-02-10', 3),
(3, 'Abstract Thoughts', 'Watercolor, 30x40 inches', 'images/art8.jpg', '2023-02-15', 4),
(4, 'Wild Nature', 'Mixed media, 50x50 inches', 'images/art9.jpg', '2023-02-20', 1),
(5, 'Portraits of the Mind', 'Digital art, high resolution', 'images/art10.jpg', '2023-02-25', 2),
(1, 'Colorful Emotions', 'Oil on canvas, 40x60 inches', 'images/art11.jpg', '2023-03-02', 3),
(2, 'The Essence of Autumn', 'Acrylic, 36x48 inches', 'images/art12.jpg', '2023-03-07', 4),
(3, 'Rhythms of the Ocean', 'Watercolor, 30x40 inches', 'images/art13.jpg', '2023-03-12', 1),
(4, 'Echoes of the Past', 'Mixed media, 50x50 inches', 'images/art14.jpg', '2023-03-17', 2);

INSERT INTO ShowcaseArtworks (weekly_showcase_id, artwork_id, showcase_day) VALUES
-- Week 1: Artist 1
(1, 1, 1), -- Artwork 1 on Day 1
(1, 6, 2), -- Artwork 6 on Day 2
-- Week 2: Artist 2
(2, 2, 1), -- Artwork 2 on Day 1
(2, 7, 2), -- Artwork 7 on Day 2
-- Week 3: Artist 3
(3, 3, 1), -- Artwork 3 on Day 1
(3, 8, 2), -- Artwork 8 on Day 2
-- Week 4: Artist 4
(4, 4, 1), -- Artwork 4 on Day 1
(4, 9, 2), -- Artwork 9 on Day 2
-- Week 5: Artist 5
(5, 5, 1), -- Artwork 5 on Day 1
(5, 10, 2), -- Artwork 10 on Day 2
-- Week 6: Artist 1
(6, 11, 1), -- Artwork 11 on Day 1
-- Week 7: Artist 2
(7, 12, 1), -- Artwork 12 on Day 1
-- Week 8: Artist 3
(8, 13, 1), -- Artwork 13 on Day 1
-- Week 9: Artist 4
(9, 14, 1); -- Artwork 14 on Day 1

INSERT INTO Comments (user_id, artwork_id, comment_text) VALUES
(1, 1, 'Amazing artwork!'),
(2, 1, 'Really love the colors in this.'),
(3, 1, 'Incredible detail.'),
(1, 2, 'Very inspiring piece.'),
(2, 2, 'Captivating work!'),
(3, 2, 'Beautiful composition.'),
-- ... (continue for more comments on different artworks)
(1, 3, 'Stunning use of light.'),
(2, 3, 'This piece is so dynamic.'),
(3, 3, 'Love the perspective.'),
(1, 4, 'Really impressive.'),
(2, 4, 'The texture is amazing.'),
-- ... (add more comments up to 20)
(3, 5, 'Such a powerful artwork.'),
(1, 5, 'Love how this speaks to me.'),
(2, 6, 'Amazing technique.'),
(3, 6, 'The concept is intriguing.'),
(1, 7, 'Really brings out the emotions.'),
(2, 7, 'Love the abstract style.'),
(3, 7, 'A true masterpiece.'),
(1, 8, 'So creative and unique.'),
(2, 8, 'This is just stunning.');

INSERT INTO Likes (user_id, artwork_id, like_date) VALUES
(1, 1, '2023-01-10'),
(2, 1, '2023-01-11'),
(3, 1, '2023-01-12'),
(4, 1, '2023-01-13'),
-- ... (continue for more likes on different artworks)
(1, 2, '2023-01-14'),
(2, 2, '2023-01-15'),
(3, 2, '2023-01-16'),
(4, 2, '2023-01-17'),
-- ... (add more likes up to 20)
(1, 3, '2023-01-18'),
(2, 3, '2023-01-19'),
(3, 3, '2023-01-20'),
(1, 4, '2023-01-21'),
(2, 4, '2023-01-22'),
(3, 4, '2023-01-23'),
(1, 5, '2023-01-24'),
(2, 5, '2023-01-25'),
(3, 5, '2023-01-26'),
(1, 6, '2023-01-27'),
(2, 6, '2023-01-28'),
(3, 6, '2023-01-29');