<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127214129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE awards (id INT AUTO_INCREMENT NOT NULL, award_name VARCHAR(200) DEFAULT NULL, award_year INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE awards_movies (awards_id INT NOT NULL, movies_id INT NOT NULL, INDEX IDX_6E34A269EC973086 (awards_id), INDEX IDX_6E34A26953F590A4 (movies_id), PRIMARY KEY(awards_id, movies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE awards_movies ADD CONSTRAINT FK_6E34A269EC973086 FOREIGN KEY (awards_id) REFERENCES awards (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE awards_movies ADD CONSTRAINT FK_6E34A26953F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE awards_movies DROP FOREIGN KEY FK_6E34A269EC973086');
        $this->addSql('ALTER TABLE awards_movies DROP FOREIGN KEY FK_6E34A26953F590A4');
        $this->addSql('DROP TABLE awards');
        $this->addSql('DROP TABLE awards_movies');
    }
}
