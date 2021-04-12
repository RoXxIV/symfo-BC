<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210412163810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE advert (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, skateshop_id INT NOT NULL, released_at DATETIME NOT NULL, description VARCHAR(500) NOT NULL, width VARCHAR(10) NOT NULL, length VARCHAR(10) NOT NULL, shape VARCHAR(10) NOT NULL, concave VARCHAR(10) NOT NULL, picture_path VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_54F1F40B7975B7E7 (model_id), INDEX IDX_54F1F40B80EFCCFC (skateshop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(128) NOT NULL, INDEX IDX_D79572D944F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skateshop (id INT AUTO_INCREMENT NOT NULL, professional_id INT NOT NULL, name VARCHAR(120) NOT NULL, street VARCHAR(255) NOT NULL, zip_code VARCHAR(5) NOT NULL, city VARCHAR(70) NOT NULL, phone VARCHAR(10) NOT NULL, INDEX IDX_C3283456DB77003 (professional_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, last_name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, siret_number VARCHAR(14) NOT NULL, phone VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE advert ADD CONSTRAINT FK_54F1F40B80EFCCFC FOREIGN KEY (skateshop_id) REFERENCES skateshop (id)');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE skateshop ADD CONSTRAINT FK_C3283456DB77003 FOREIGN KEY (professional_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B7975B7E7');
        $this->addSql('ALTER TABLE advert DROP FOREIGN KEY FK_54F1F40B80EFCCFC');
        $this->addSql('ALTER TABLE skateshop DROP FOREIGN KEY FK_C3283456DB77003');
        $this->addSql('DROP TABLE advert');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE skateshop');
        $this->addSql('DROP TABLE `user`');
    }
}
