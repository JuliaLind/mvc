DROP TABLE IF EXISTS book;

CREATE TABLE book (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    title VARCHAR(255) NOT NULL,
    isbn CHAR(13) NOT NULL UNIQUE,
    author VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL
);

-- DELETE FROM book;

-- use only from terminal
-- .mode csv
-- .import csv/book.csv book

INSERT INTO book VALUES(1,'Python Crash Course, 3rd Edition','9781718502703','Eric Matthes','https://image.bokus.com/images/9781718502703_200x_python-crash-course-3rd-edition_haftad');
INSERT INTO book VALUES(2,'JavaScript - The Definitive Guide','9781491952023','David Flanagan','https://image.bokus.com/images/9781491952023_200x_javascript-the-definitive-guide_haftad');
INSERT INTO book VALUES(3,'Web Development with Node and Express','9781492053514','Ethan Brown','https://image.bokus.com/images/9781492053514_200x_web-development-with-node-and-express_haftad');
INSERT INTO book VALUES(4,'Databasteknik','9789144069197','Thomas Padron-Mccarthy, Tore Risch','https://image.bokus.com/images/9789144069197_200x_databasteknik');
INSERT INTO book VALUES(5,'Webbutveckling med PHP och MySQL','9789144105567','Montathar Faraon','https://image.bokus.com/images/9789144105567_200x_webbutveckling-med-php-och-mysql_haftad');
INSERT INTO book VALUES(6,'The Principles of Beautiful Web Design, 4e','9781925836363','Jason Beaird, Alex Walker','https://image.bokus.com/images/9781925836363_200x_the-principles-of-beautiful-web-design-4e_haftad');

-- INSERT INTO book 
--     (id, title, isbn, author, img) 
-- VALUES
--     (1,'Python Crash Course, 3rd Edition','9781718502703','Eric Matthes','https://image.bokus.com/images/9781718502703_200x_python-crash-course-3rd-edition_haftad'),
--     (2,'JavaScript - The Definitive Guide','9781491952023','David Flanagan','https://image.bokus.com/images/9781491952023_200x_javascript-the-definitive-guide_haftad'),
--     (3,'Web Development with Node and Express','9781492053514','Ethan Brown','https://image.bokus.com/images/9781492053514_200x_web-development-with-node-and-express_haftad'),
--     (4,'Databasteknik','9789144069197','Thomas Padron-Mccarthy, Tore Risch','https://image.bokus.com/images/9789144069197_200x_databasteknik'),
--     (5,'Webbutveckling med PHP och MySQL','9789144105567','Montathar Faraon','https://image.bokus.com/images/9789144105567_200x_webbutveckling-med-php-och-mysql_haftad'),
--     (6,'The Principles of Beautiful Web Design, 4e','9781925836363','Jason Beaird, Alex Walker','https://image.bokus.com/images/9781925836363_200x_the-principles-of-beautiful-web-design-4e_haftad')
-- ;
