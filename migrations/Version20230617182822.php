<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * @SuppressWarnings(PHPMD)
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617182822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, userid_id INTEGER NOT NULL, registered DATE NOT NULL, points INTEGER NOT NULL, CONSTRAINT FK_3299375158E0A285 FOREIGN KEY (userid_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3299375158E0A285 ON score (userid_id)');
        $this->addSql('CREATE TABLE "transaction" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, userid_id INTEGER NOT NULL, registered DATE NOT NULL, descr VARCHAR(100) NOT NULL, amount INTEGER NOT NULL, CONSTRAINT FK_723705D158E0A285 FOREIGN KEY (userid_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_723705D158E0A285 ON "transaction" (userid_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(100) NOT NULL, acronym VARCHAR(50) NOT NULL, hash VARCHAR(100) NOT NULL)');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, isbn, author, img FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, isbn VARCHAR(13) NOT NULL, author VARCHAR(255) NOT NULL, img VARCHAR(100) NOT NULL)');
        $this->addSql('INSERT INTO book (id, title, isbn, author, img) SELECT id, title, isbn, author, img FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE "BINARY", value INTEGER NOT NULL)');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE "transaction"');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, title, isbn, author, img FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, isbn CHAR(13) NOT NULL, author VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO book (id, title, isbn, author, img) SELECT id, title, isbn, author, img FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
