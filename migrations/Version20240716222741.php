<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716222741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_expense (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_task (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense (id INT AUTO_INCREMENT NOT NULL, category_expense_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, amount NUMERIC(10, 4) NOT NULL, description VARCHAR(255) DEFAULT NULL, date_payment DATETIME DEFAULT NULL, date_due DATETIME DEFAULT NULL, date_reception DATETIME DEFAULT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, INDEX IDX_2D3A8DA6D58B8B05 (category_expense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, category_task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date_due DATETIME DEFAULT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, date_effective DATETIME DEFAULT NULL, INDEX IDX_527EDB254A6E41F8 (category_task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA6D58B8B05 FOREIGN KEY (category_expense_id) REFERENCES category_expense (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB254A6E41F8 FOREIGN KEY (category_task_id) REFERENCES category_task (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA6D58B8B05');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB254A6E41F8');
        $this->addSql('DROP TABLE category_expense');
        $this->addSql('DROP TABLE category_task');
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE task');
    }
}
