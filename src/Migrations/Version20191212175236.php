<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212175236 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achievement (id INT AUTO_INCREMENT NOT NULL, student VARCHAR(255) NOT NULL, teacher VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, grade INT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attendance (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, subject VARCHAR(255) NOT NULL, teacher VARCHAR(255) NOT NULL, student VARCHAR(255) NOT NULL, attended TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_work (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) NOT NULL, teacher VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, home_work_text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_all (id INT AUTO_INCREMENT NOT NULL, sender VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_individual (id INT AUTO_INCREMENT NOT NULL, sender VARCHAR(255) NOT NULL, addressee VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observation (id INT AUTO_INCREMENT NOT NULL, teacher VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, observation_text VARCHAR(255) NOT NULL, addressee VARCHAR(255) NOT NULL,date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, sub_id INT NOT NULL, subject VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, sub_id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE achievement');
        $this->addSql('DROP TABLE attendance');
        $this->addSql('DROP TABLE home_work');
        $this->addSql('DROP TABLE message_all');
        $this->addSql('DROP TABLE message_individual');
        $this->addSql('DROP TABLE observation');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE subject');
    }
}
