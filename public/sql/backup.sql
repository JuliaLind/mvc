PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE doctrine_migration_versions (version VARCHAR(191) NOT NULL, executed_at DATETIME DEFAULT NULL, execution_time INTEGER DEFAULT NULL, PRIMARY KEY(version));
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20230502223002','2023-05-02 22:33:19',2);
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20230505221238','2023-05-05 22:32:17',3);
INSERT INTO doctrine_migration_versions VALUES('DoctrineMigrations\Version20230617182822','2023-06-17 18:29:29',4);
CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL);
CREATE TABLE book (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    title VARCHAR(255) NOT NULL,
    isbn CHAR(13) NOT NULL UNIQUE,
    author VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL
);
INSERT INTO book VALUES(1,'Python Crash Course, 3rd Edition','9781718502703','Eric Matthes','https://image.bokus.com/images/9781718502703_200x_python-crash-course-3rd-edition_haftad');
INSERT INTO book VALUES(2,'JavaScript - The Definitive Guide','9781491952023','David Flanagan','https://image.bokus.com/images/9781491952023_200x_javascript-the-definitive-guide_haftad');
INSERT INTO book VALUES(3,'Web Development with Node and Express','9781492053514','Ethan Brown','https://image.bokus.com/images/9781492053514_200x_web-development-with-node-and-express_haftad');
INSERT INTO book VALUES(4,'Databasteknik','9789144069197','Thomas Padron-Mccarthy, Tore Risch','https://image.bokus.com/images/9789144069197_200x_databasteknik');
INSERT INTO book VALUES(5,'Webbutveckling med PHP och MySQL','9789144105567','Montathar Faraon','https://image.bokus.com/images/9789144105567_200x_webbutveckling-med-php-och-mysql_haftad');
INSERT INTO book VALUES(6,'The Principles of Beautiful Web Design, 4e','9781925836363','Jason Beaird, Alex Walker','https://image.bokus.com/images/9781925836363_200x_the-principles-of-beautiful-web-design-4e_haftad');
CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    acronym VARCHAR(50) NOT NULL UNIQUE,
    hash VARCHAR(100) NOT NULL
);
INSERT INTO user VALUES(1,'doe@bth.se','John Doe','$2y$10$bh4KbO6upQywlhconQZf1.0UMbpV1qnhVy3WRa7wd2/2KlsjPq.AW');
INSERT INTO user VALUES(2,'jane@bth.se','Jane Doe','$2y$10$4gdzy9YYN7O.g325RtWimuuowzW.3umg6.lAGHn8zkNoVFVU0QJ1O');
INSERT INTO user VALUES(3,'julia@bth.se','Julia','$2y$10$CFPX00V9Xlx2MoaISX6fVuzY.IjAUtxEgUXibpWCyyJMcNdnPtNfy');
CREATE TABLE score (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    registered DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    points INTEGER NOT NULL,
    CONSTRAINT FK_3299375158E0A285 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
);
INSERT INTO score VALUES(1,2,'2023-07-10',68);
INSERT INTO score VALUES(2,2,'2023-07-10',106);
INSERT INTO score VALUES(3,2,'2023-07-11',98);
INSERT INTO score VALUES(4,1,'2023-07-11',106);
INSERT INTO score VALUES(5,1,'2023-07-11',172);
INSERT INTO score VALUES(6,3,'2023-07-13',142);
INSERT INTO score VALUES(7,3,'2023-07-13',151);
INSERT INTO score VALUES(8,3,'2023-07-14',83);
INSERT INTO score VALUES(9,3,'2023-07-14',126);
INSERT INTO score VALUES(10,3,'2023-07-14',225);
CREATE TABLE IF NOT EXISTS "transaction" (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    registered DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    descr VARCHAR(100) NOT NULL, amount INTEGER NOT NULL, CONSTRAINT FK_723705D158E0A285 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
);
INSERT INTO "transaction" VALUES(1,1,'2023-06-18','Free registration bonus',1000);
INSERT INTO "transaction" VALUES(2,2,'2023-07-09','Free registration bonus',1000);
INSERT INTO "transaction" VALUES(3,2,'2023-07-10','Bet',-30);
INSERT INTO "transaction" VALUES(4,2,'2023-07-10','Bet',-970);
INSERT INTO "transaction" VALUES(5,2,'2023-07-10','Purchase',100);
INSERT INTO "transaction" VALUES(6,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(7,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(8,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(9,2,'2023-07-10','Bet',-10);
INSERT INTO "transaction" VALUES(10,2,'2023-07-10','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(12,2,'2023-07-10','Bet',-10);
INSERT INTO "transaction" VALUES(13,2,'2023-07-10','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(14,2,'2023-07-10','Purchase',550);
INSERT INTO "transaction" VALUES(15,2,'2023-07-10','Purchase',10100);
INSERT INTO "transaction" VALUES(16,2,'2023-07-10','Bet',-10);
INSERT INTO "transaction" VALUES(17,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(18,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(19,2,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(20,2,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(21,2,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(22,2,'2023-07-11','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(23,1,'2023-07-11','Bet',-10);
INSERT INTO "transaction" VALUES(24,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(25,1,'2023-07-11','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(26,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(27,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(28,1,'2023-07-11','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(29,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(30,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(31,1,'2023-07-11','Purchase',10100);
INSERT INTO "transaction" VALUES(32,1,'2023-07-11','Bet',-10);
INSERT INTO "transaction" VALUES(33,1,'2023-07-11','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(34,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(35,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(36,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(37,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(38,1,'2023-07-11','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(39,3,'2023-07-13','Free registration bonus',1000);
INSERT INTO "transaction" VALUES(40,3,'2023-07-13','Bet',-110);
INSERT INTO "transaction" VALUES(41,3,'2023-07-13','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(42,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(43,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(44,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(45,3,'2023-07-13','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(46,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(47,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(48,3,'2023-07-13','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(49,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(50,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(51,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(52,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(53,3,'2023-07-13','Purchase',10100);
INSERT INTO "transaction" VALUES(54,3,'2023-07-13','Bet',-1590);
INSERT INTO "transaction" VALUES(55,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(56,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(57,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(58,3,'2023-07-13','Return (bet x 2)',3180);
INSERT INTO "transaction" VALUES(59,3,'2023-07-13','Bet',-10);
INSERT INTO "transaction" VALUES(60,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(61,3,'2023-07-13','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(62,3,'2023-07-13','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(63,3,'2023-07-13','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(64,3,'2023-07-13','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(65,3,'2023-07-13','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(66,3,'2023-07-14','Bet',-10);
INSERT INTO "transaction" VALUES(67,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(68,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(69,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(70,3,'2023-07-14','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(71,3,'2023-07-14','Bet',-10);
INSERT INTO "transaction" VALUES(72,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(73,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(74,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(75,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(76,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(77,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(78,3,'2023-07-14','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(79,3,'2023-07-14','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(80,3,'2023-07-14','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(81,3,'2023-07-14','Purchase',550);
INSERT INTO "transaction" VALUES(82,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(83,3,'2023-07-14','Purchase',550);
INSERT INTO "transaction" VALUES(84,3,'2023-07-14','Purchase',10100);
INSERT INTO "transaction" VALUES(85,3,'2023-07-14','Bet',-1200);
INSERT INTO "transaction" VALUES(86,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(87,3,'2023-07-14','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(89,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(90,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(91,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(92,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(93,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(94,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(95,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(96,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(97,3,'2023-07-14','Purchase',25200);
INSERT INTO "transaction" VALUES(98,3,'2023-07-14','Bet',-10);
INSERT INTO "transaction" VALUES(99,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(100,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(101,3,'2023-07-14','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(102,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(103,3,'2023-07-14','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(104,3,'2023-07-14','Bet',-1490);
INSERT INTO "transaction" VALUES(105,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(106,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(107,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(108,3,'2023-07-14','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(109,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(110,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(111,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(112,3,'2023-07-14','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(113,3,'2023-07-14','Return (bet x 2)',2980);
INSERT INTO "transaction" VALUES(114,3,'2023-07-14','Purchase',100);
INSERT INTO "transaction" VALUES(115,3,'2023-07-14','Purchase',550);
INSERT INTO "transaction" VALUES(116,3,'2023-07-14','Purchase',550);
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence VALUES('book',6);
INSERT INTO sqlite_sequence VALUES('user',3);
INSERT INTO sqlite_sequence VALUES('score',10);
INSERT INTO sqlite_sequence VALUES('transaction',116);
CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name);
CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at);
CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at);
COMMIT;
