<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521121242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE authors (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE publishers (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE books (
            id INT AUTO_INCREMENT NOT NULL,
            title VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            status VARCHAR(50) NOT NULL,
            author_id INT DEFAULT NULL,
            publisher_id INT DEFAULT NULL,
            INDEX IDX_4A1B2A92F675F31B (author_id),
            INDEX IDX_4A1B2A927C455263 (publisher_id),
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A92F675F31B FOREIGN KEY (author_id) REFERENCES authors (id)');
        $this->addSql('ALTER TABLE books ADD CONSTRAINT FK_4A1B2A927C455263 FOREIGN KEY (publisher_id) REFERENCES publishers (id)');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A92F675F31B');
        $this->addSql('ALTER TABLE books DROP FOREIGN KEY FK_4A1B2A927C455263');
        $this->addSql('DROP TABLE books');
        $this->addSql('DROP TABLE authors');
        $this->addSql('DROP TABLE publishers');

    }
}
