<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127230936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE casting (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(200) DEFAULT NULL, lastname VARCHAR(200) DEFAULT NULL, role VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE casting_movies (casting_id INT NOT NULL, movies_id INT NOT NULL, INDEX IDX_2E71AB789EB2648F (casting_id), INDEX IDX_2E71AB7853F590A4 (movies_id), PRIMARY KEY(casting_id, movies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_movies (categories_id INT NOT NULL, movies_id INT NOT NULL, INDEX IDX_CE77D308A21214B7 (categories_id), INDEX IDX_CE77D30853F590A4 (movies_id), PRIMARY KEY(categories_id, movies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries (id INT AUTO_INCREMENT NOT NULL, country_name VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countries_movies (countries_id INT NOT NULL, movies_id INT NOT NULL, INDEX IDX_4AC706CEAEBAE514 (countries_id), INDEX IDX_4AC706CE53F590A4 (movies_id), PRIMARY KEY(countries_id, movies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casting_movies ADD CONSTRAINT FK_2E71AB789EB2648F FOREIGN KEY (casting_id) REFERENCES casting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE casting_movies ADD CONSTRAINT FK_2E71AB7853F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_movies ADD CONSTRAINT FK_CE77D308A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_movies ADD CONSTRAINT FK_CE77D30853F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE countries_movies ADD CONSTRAINT FK_4AC706CEAEBAE514 FOREIGN KEY (countries_id) REFERENCES countries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE countries_movies ADD CONSTRAINT FK_4AC706CE53F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casting_movies DROP FOREIGN KEY FK_2E71AB789EB2648F');
        $this->addSql('ALTER TABLE casting_movies DROP FOREIGN KEY FK_2E71AB7853F590A4');
        $this->addSql('ALTER TABLE categories_movies DROP FOREIGN KEY FK_CE77D308A21214B7');
        $this->addSql('ALTER TABLE categories_movies DROP FOREIGN KEY FK_CE77D30853F590A4');
        $this->addSql('ALTER TABLE countries_movies DROP FOREIGN KEY FK_4AC706CEAEBAE514');
        $this->addSql('ALTER TABLE countries_movies DROP FOREIGN KEY FK_4AC706CE53F590A4');
        $this->addSql('DROP TABLE casting');
        $this->addSql('DROP TABLE casting_movies');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_movies');
        $this->addSql('DROP TABLE countries');
        $this->addSql('DROP TABLE countries_movies');
    }
}
