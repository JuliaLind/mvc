PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE doctrine_migration_versions (version VARCHAR(191) NOT NULL, executed_at DATETIME DEFAULT NULL, execution_time INTEGER DEFAULT NULL, PRIMARY KEY(version));
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20230502223002','2023-05-02 22:33:19',2);
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20230505221238','2023-05-05 22:32:17',3);
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20230617182822','2023-06-17 18:29:29',4);
CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL);
CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, isbn VARCHAR(13) NOT NULL, author VARCHAR(255) NOT NULL, img VARCHAR(100) NOT NULL);
INSERT INTO book VALUES(1,'Python Crash Course, 3rd Edition','9781718502703','Eric Matthes','https://image.bokus.com/images/9781718502703_200x_python-crash-course-3rd-edition_haftad');
INSERT INTO book VALUES(2,'JavaScript - The Definitive Guide','9781491952023','David Flanagan','https://image.bokus.com/images/9781491952023_200x_javascript-the-definitive-guide_haftad');
INSERT INTO book VALUES(3,'Web Development with Node and Express','9781492053514','Ethan Brown','https://image.bokus.com/images/9781492053514_200x_web-development-with-node-and-express_haftad');
INSERT INTO book VALUES(4,'Databasteknik','9789144069197','Thomas Padron-Mccarthy, Tore Risch','https://image.bokus.com/images/9789144069197_200x_databasteknik');
INSERT INTO book VALUES(5,'Webbutveckling med PHP och MySQL','9789144105567','Montathar Faraon','https://image.bokus.com/images/9789144105567_200x_webbutveckling-med-php-och-mysql_haftad');
INSERT INTO book VALUES(6,'The Principles of Beautiful Web Design, 4e','9781925836363','Jason Beaird, Alex Walker','https://image.bokus.com/images/9781925836363_200x_the-principles-of-beautiful-web-design-4e_haftad');
CREATE TABLE score (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    userid_id INTEGER NOT NULL,
    registered DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    points INTEGER NOT NULL,
    CONSTRAINT FK_3299375158E0A285 FOREIGN KEY (userid_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE TABLE IF NOT EXISTS "transaction" (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    userid_id INTEGER NOT NULL,
    registered DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    descr VARCHAR(100) NOT NULL, amount INTEGER NOT NULL, CONSTRAINT FK_723705D158E0A285 FOREIGN KEY (userid_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
);
INSERT INTO "transaction" VALUES(1,1,'2023-06-18','Free registration bonus',1000);
CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    acronym VARCHAR(50) NOT NULL UNIQUE,
    hash VARCHAR(100) NOT NULL
);
INSERT INTO user VALUES(1,'doe@bth.se','John Doe','$2y$10$bh4KbO6upQywlhconQZf1.0UMbpV1qnhVy3WRa7wd2/2KlsjPq.AW');
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence VALUES('book',6);
INSERT INTO sqlite_sequence VALUES('transaction',1);
INSERT INTO sqlite_sequence VALUES('user',1);
CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name);
CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at);
CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at);
COMMIT;
