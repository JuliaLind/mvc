DROP TABLE IF EXISTS product;

CREATE TABLE product (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    value INTEGER NOT NULL
    );

INSERT INTO product VALUES(1,'Keyboard_num_2',900);
INSERT INTO product VALUES(2,'Keyboard_num_5',1000);
INSERT INTO product VALUES(3,'Keyboard_num_1',707);
INSERT INTO product VALUES(4,'Keyboard_num_1',547);