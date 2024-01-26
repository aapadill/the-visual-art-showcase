INSERT INTO Users (username, email, password, profile_picture, name, bio, location, role_id) VALUES 
    ('jill', 'jill@example.com', 'pass1234', 'images/jill.jpg', 'Jill Tate', 'Artist and designer from New York.', 'New York', 1),
    ('seppe', 'seppe@example.com', 'pass2345', 'images/seppe.jpg', 'Seppe D Meyere', 'Freelance illustrator based in San Francisco.', 'San Francisco', 1),
    ('kevin', 'kevin@example.com', 'pass3456', 'images/kevin.jpg', 'Kevin Schott', 'Aspiring digital artist and animator.', 'Los Angeles', 1),
    ('keita', 'keita@example.com', 'pass4567', 'images/keita.jpg', 'Keita M', 'Professional photographer and visual artist.', 'Chicago', 1),
    ('giani', 'giani@example.com', 'pass5678', 'images/giani.jpg', 'Gianni N', 'Graphic designer with a passion for street art.', 'Houston', 1),
    ('diane', 'lindawilliams@example.com', 'pass6789', 'images/linda_pic.jpg', 'Linda Williams', 'Abstract painter and art instructor.', 'Philadelphia', 1),
    ('chrisevans', 'chrisevans@example.com', 'pass7890', 'images/chris_pic.jpg', 'Chris Evans', 'Contemporary artist focusing on environmental themes.', 'Phoenix', 1),
    ('oliviawilson', 'oliviawilson@example.com', 'pass8901', 'images/olivia_pic.jpg', 'Olivia Wilson', 'Mixed media artist and freelance designer.', 'San Antonio', 1),
    ('jamesmoore', 'jamesmoore@example.com', 'pass9012', 'images/james_pic.jpg', 'James Moore', 'Landscape painter and art history enthusiast.', 'San Diego', 1),
    ('laurataylor', 'laurataylor@example.com', 'pass0123', 'images/laura_pic.jpg', 'Laura Taylor', 'Ceramic artist and pottery workshop instructor.', 'Dallas', 1);

INSERT INTO Artists (user_id, artist_name, bio, website, social_media, role_id) VALUES
    (1, 'Jill Tate', 'Jill Tate is a visual artist based in Newcastle upon Tyne, UK. With an educational background in photography, Tate got her start as a professional architectural photographer before pivoting toward painting, which has formed the core of her creative practice since 2017. The influence of her earlier architectural interests can be seen in her current work, which features carefully rendered minimalist interiors based on scale models she has constructed and photographed. “I am interested in our experience of home and its existence at different scales, such as the mind, the houses we inhabit, and our shared planet,” she explains. “Using a natural, monochromatic colour palette and evoking the softened geometry of raw earth buildings, my work digs down to the underlying unity at the root of all things, contemplating the physical and psychological structures that surround and shape us.”', 'https://www.jilltate.co.uk/', 'www.instagram.com/alexsmithart/', 2),

    (2, 'Seppe de Meyere', 'Paintings by Belgium-based artist Seppe De Meyere, which he describes as “provoked by atmospheres of unease, gloom and stasis” and “a slow digestion of the human form over time”. The works feel foreign and familiar at the same time and this tension draws the viewer in. De Meyere is part of 404 Collective and the art community they’ve started called Cane Yo. See more of his work below.', 'https://seppedemeyere.com/', 'https://www.instagram.com/seppedemeyere/', 2),

    (3, 'Kevin Schott', 'Images from a series of 40 works by artist Kevin Schott. From Bochum, Germany, Schott started out doing graffiti while working at a fast food restaurant. He quit his job after 10 years and taught himself how to pain in oils. In addition to his studio work, Schott leads graffiti workshops for kids and teenagers. The way they see the world has become a source of inspiration for his paintings. His current series, “40×40,” will be completed at the end of the year with a small book. Check out more images below!', 'https://www.kevinschott.art/', 'https://www.instagram.com/aet_schott/', 2),

    (4, 'Keita Morimoto', 'A selection of paintings by Japanese artist Keita Morimoto (previously featured here). Born in Osaka and currently based in Tokyo, Morimoto moved to Canada after graduating from high school. He lived in Toronto for 16 years before returning to Japan in 2022. Morimoto’s artistic approach is highly empathetic as he often places himself in the shoes of his subjects, painting from their perspective rather than asserting himself or his own point of view. His latest solo exhibition builds on previously explored themes such as the challenges of contemporary urban life and the specialness of the ordinary or everyday. Based on his own photographs, Morimoto’s paintings do not depict fictional worlds imagined by the artist. They represent special moments in the lives of his subjects wherein they are able to assert their individuality without being constrained by the roles society has assigned them. See more images from “A Little Closer” below or on display at Kotaro Nukaga, Roppongi until September 16.', 'https://www.keitamorimoto.com/', 'https://www.instagram.com/morimotostudio/', 2),

    (5, 'Gianni Notarianni', 'Forest paintings by UK-based artist Gianni Notarianni. The series was inspired by a residency in Ontario, Canada at a turning point in his life. Transitioning from monk to painter, Notarianni found in the forests outside Toronto a visual equivalent to his interior journey. His work offers a meditative exploration of the transcendent as seen in the rhythms and patterns of the natural world. Passing through seasons and times of day, Notarianni can also be seen playing with both the micro and macro levels of landscape through the slow build up of details and close observation of light, shadow, and the spatial relationships of various forms. Check out more images from “Everything the Light Touches” below or on display at Hawk + Hive gallery in Andes, New York from September 23rd until October 29th.', 'https://www.hawkandhive.com/gianninotarianni2', 'https://www.instagram.com/gianni_notarianni_art/', 2),

    (6, 'Diane Dalpra', 'Enticing yet disquieting paintings by French artist Diane Dal-pra (previously featured here). Currently on display with Massimo de Carlo at Mostyn gallery in Wales, Dal-pra’s latest exhibition explores the duality of possessions and how the objects we own can both consume and comfort us. While objects may provide a sense of reassurance, their permanence can also lead to more precarious attachments and superstitions. Dal-pra’s body of work focuses on our daily life rituals, relationships, obsessions, and sensations as bodies appear enmeshed in the broader psychological ambiguity of the intimate roles certain items play in our lives and imaginations.', '', 'https://www.instagram.com/dianedal_pra/?hl=fr', 2),

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

INSERT INTO WeeklyShowcase (week_start_date, week_end_date, featured_artist_id) VALUES
('2024-01-01', '2024-01-07', 1),
('2024-01-08', '2024-01-14', 2),
('2024-01-15', '2024-01-21', 3),
('2024-01-22', '2024-01-28', 4),
('2024-01-29', '2024-02-04', 5),
('2024-02-05', '2024-02-11', 6);

INSERT INTO Artworks (artwork_id, artist_id, title, technical_sheet, image_url, upload_date, category_id) VALUES
(1, 'Abstract Sunrise', 'Oil on canvas, 40x60 inches', 'images/artworks/art1.jpg', '2024-01-10', 1),
(1, 'Morning Glory', 'Oil on canvas, 45x65 inches', 'images/artworks/art2.jpg', '2024-01-17', 1),
(1, 'Evening Hues', 'Oil on canvas, 38x55 inches', 'images/artworks/art3.jpg', '2024-01-24', 1),
(1, 'Nature’s Whisper', 'Oil on canvas, 50x70 inches', 'images/artworks/art4.jpg', '2024-01-31', 1),
(1, 'Urban Dreams', 'Oil on canvas, 40x60 inches', 'images/artworks/art5.jpg', '2024-02-07', 1),
(1, 'Serenity', 'Oil on canvas, 36x48 inches', 'images/artworks/art6.jpg', '2024-02-14', 1),
(1, 'Chaos in Color', 'Oil on canvas, 42x62 inches', 'images/artworks/art7.jpg', '2024-02-21', 1),

(2, 'Urban Landscape', 'Acrylic, 36x48 inches', 'images/artworks/art8.jpg', '2024-01-11', 2),
(2, 'City Life', 'Acrylic, 34x44 inches', 'images/artworks/art9.jpg', '2024-01-18', 2),
(2, 'The Bustle', 'Acrylic, 30x40 inches', 'images/artworks/art10.jpg', '2024-01-25', 2),
(2, 'Street Views', 'Acrylic, 38x58 inches', 'images/artworks/art11.jpg', '2024-02-01', 2),
(2, 'Skylines', 'Acrylic, 40x60 inches', 'images/artworks/art12.jpg', '2024-02-08', 2),
(2, 'Metropolis', 'Acrylic, 42x52 inches', 'images/artworks/art13.jpg', '2024-02-15', 2),
(2, 'Neon Nights', 'Acrylic, 36x46 inches', 'images/artworks/art14.jpg', '2024-02-22', 2),

(3, 'The Lonely Tree', 'Watercolor, 30x40 inches', 'images/artworks/art15.jpg', '2024-01-12', 3),
(3, 'Forest Whisper', 'Watercolor, 32x42 inches', 'images/artworks/art16.jpg', '2024-01-19', 3),
(3, 'Misty Mountains', 'Watercolor, 28x38 inches', 'images/artworks/art17.jpg', '2024-01-26', 3),
(3, 'River Bend', 'Watercolor, 35x45 inches', 'images/artworks/art18.jpg', '2024-02-02', 3),
(3, 'Autumn Leaves', 'Watercolor, 33x43 inches', 'images/artworks/art19.jpg', '2024-02-09', 3),
(3, 'Spring Bloom', 'Watercolor, 31x41 inches', 'images/artworks/art20.jpg', '2024-02-16', 3);
(3, 'Summer Reflection', 'Watercolor, 29x39 inches', 'images/artworks/art21.jpg', '2024-02-23', 3),

(4, 'Distant Horizon', 'Oil on canvas, 40x60 inches', 'images/artworks/art22.jpg', '2024-01-13', 1),
(4, 'Twilight Shades', 'Oil on canvas, 45x65 inches', 'images/artworks/art23.jpg', '2024-01-20', 1),
(4, 'Moonlit Path', 'Oil on canvas, 38x55 inches', 'images/artworks/art24.jpg', '2024-01-27', 1),
(4, 'Starlit Night', 'Oil on canvas, 50x70 inches', 'images/artworks/art25.jpg', '2024-02-03', 1),
(4, 'Harbor Lights', 'Oil on canvas, 40x60 inches', 'images/artworks/art26.jpg', '2024-02-10', 1),
(4, 'Ocean Breeze', 'Oil on canvas, 36x48 inches', 'images/artworks/art27.jpg', '2024-02-17', 1),
(4, 'Seaside Dreams', 'Oil on canvas, 42x62 inches', 'images/artworks/art28.jpg', '2024-02-24', 1),

(5, 'Floral Essence', 'Acrylic, 36x48 inches', 'images/artworks/art29.jpg', '2024-01-14', 2),
(5, 'Blossom Garden', 'Acrylic, 34x44 inches', 'images/artworks/art30.jpg', '2024-01-21', 2),
(5, 'Spring Awakening', 'Acrylic, 30x40 inches', 'images/artworks/art31.jpg', '2024-01-28', 2),
(5, 'Vibrant Petals', 'Acrylic, 38x58 inches', 'images/artworks/art32.jpg', '2024-02-04', 2),
(5, 'Nature’s Canvas', 'Acrylic, 40x60 inches', 'images/artworks/art33.jpg', '2024-02-11', 2),
(5, 'Sunflower Field', 'Acrylic, 42x52 inches', 'images/artworks/art34.jpg', '2024-02-18', 2),
(5, 'Morning Dew', 'Acrylic, 36x46 inches', 'images/artworks/art35.jpg', '2024-02-25', 2),

(6, 'Artwork Title 1', 'Technical Sheet 1', 'images/artworks/art36.jpg', '2024-01-15', 3),
(6, 'Artwork Title 2', 'Technical Sheet 2', 'images/artworks/art37.jpg', '2024-01-22', 3),
(6, 'Artwork Title 3', 'Technical Sheet 3', 'images/artworks/art38.jpg', '2024-01-29', 3),
(6, 'Artwork Title 4', 'Technical Sheet 4', 'images/artworks/art39.jpg', '2024-02-05', 3),
(6, 'Artwork Title 5', 'Technical Sheet 5', 'images/artworks/art40.jpg', '2024-02-12', 3),
(6, 'Artwork Title 6', 'Technical Sheet 6', 'images/artworks/art41.jpg', '2024-02-19', 3),
(6, 'Artwork Title 7', 'Technical Sheet 7', 'images/artworks/art42.jpg', '2024-02-26', 3);

INSERT INTO ShowcaseArtworks (weekly_showcase_id, artwork_id, showcase_day) VALUES
-- Week 1: Artist 1
(1, 1, 1), (1, 2, 2), (1, 3, 3), (1, 4, 4), (1, 5, 5), (1, 6, 6), (1, 7, 7),

-- Week 2: Artist 2
(2, 8, 1), (2, 9, 2), (2, 10, 3), (2, 11, 4), (2, 12, 5), (2, 13, 6), (2, 14, 7),

-- Week 3: Artist 3
(3, 15, 1), (3, 16, 2), (3, 17, 3), (3, 18, 4), (3, 19, 5), (3, 20, 6), (3, 21, 7),

-- Week 4: Artist 4
(4, 22, 1), (4, 23, 2), (4, 24, 3), (4, 25, 4), (4, 26, 5), (4, 27, 6), (4, 28, 7),

-- Week 5: Artist 5
(5, 29, 1), (5, 30, 2), (5, 31, 3), (5, 32, 4), (5, 33, 5), (5, 34, 6), (5, 35, 7),

-- Week 6: Artist 6
(6, 36, 1), (6, 37, 2), (6, 38, 3), (6, 39, 4), (6, 40, 5), (6, 41, 6), (6, 42, 7);


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