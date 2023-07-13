DROP TABLE IF EXISTS "transaction";
DROP TABLE IF EXISTS "score";
DROP TABLE IF EXISTS "user";

CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    acronym VARCHAR(50) NOT NULL UNIQUE,
    hash VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS score (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    registered DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    points INTEGER NOT NULL,
    CONSTRAINT FK_3299375158E0A285 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
);

CREATE TABLE IF NOT EXISTS "transaction" (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,
    registered DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    descr VARCHAR(100) NOT NULL, amount INTEGER NOT NULL, CONSTRAINT FK_723705D158E0A285 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE
);

INSERT INTO user VALUES(1,'doe@bth.se','John Doe','$2y$10$bh4KbO6upQywlhconQZf1.0UMbpV1qnhVy3WRa7wd2/2KlsjPq.AW');
INSERT INTO user VALUES(2,'jane@bth.se','Jane Doe','$2y$10$4gdzy9YYN7O.g325RtWimuuowzW.3umg6.lAGHn8zkNoVFVU0QJ1O');


INSERT INTO score VALUES(1,2,'2023-07-10',68);
INSERT INTO score VALUES(2,2,'2023-07-10',111);
INSERT INTO score VALUES(3,2,'2023-07-10',86);
INSERT INTO score VALUES(4,2,'2023-07-10',106);
INSERT INTO score VALUES(5,1,'2023-07-11',104);
INSERT INTO score VALUES(6,1,'2023-07-11',106);
INSERT INTO score VALUES(7,1,'2023-07-11',172);

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
INSERT INTO "transaction" VALUES(12,2,'2023-07-10','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(13,2,'2023-07-10','Bet',-10);
INSERT INTO "transaction" VALUES(16,2,'2023-07-10','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(19,2,'2023-07-10','Purchase',550);
INSERT INTO "transaction" VALUES(22,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(26,2,'2023-07-10','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(37,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(38,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(50,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(51,2,'2023-07-10','Purchase',550);
INSERT INTO "transaction" VALUES(52,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(53,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(54,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(55,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(56,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(71,2,'2023-07-10','Purchase',10100);
INSERT INTO "transaction" VALUES(72,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(73,2,'2023-07-10','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(74,2,'2023-07-10','Bet',-10);
INSERT INTO "transaction" VALUES(75,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(76,2,'2023-07-10','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(83,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(84,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(85,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(91,1,'2023-07-11','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(92,1,'2023-07-11','Bet',-10);
INSERT INTO "transaction" VALUES(93,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(94,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(95,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(96,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(97,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(98,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(99,1,'2023-07-11','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(100,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(107,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(108,1,'2023-07-11','Purchase',550);
INSERT INTO "transaction" VALUES(109,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(110,1,'2023-07-11','Return (bet x 2)',20);
INSERT INTO "transaction" VALUES(111,1,'2023-07-11','Bet',-10);
INSERT INTO "transaction" VALUES(112,1,'2023-07-11','Bet',-10);
INSERT INTO "transaction" VALUES(113,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(114,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(115,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(119,1,'2023-07-11','Purchase',10100);
INSERT INTO "transaction" VALUES(120,1,'2023-07-11','Bet',-10);
INSERT INTO "transaction" VALUES(123,1,'2023-07-11','undo last move cheat',-10);
INSERT INTO "transaction" VALUES(124,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(125,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(126,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(127,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(128,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(129,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(130,1,'2023-07-11','move-a-card cheat',-50);
INSERT INTO "transaction" VALUES(131,1,'2023-07-11','show-suggestion cheat',-30);
INSERT INTO "transaction" VALUES(132,1,'2023-07-11','Return (bet x 2)',20);
