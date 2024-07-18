<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240718203528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA6D58B8B05');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB254A6E41F8');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, type_category VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, event_id INT DEFAULT NULL, task_id INT DEFAULT NULL, expense_id INT DEFAULT NULL, house_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, file VARBINARY(255) NOT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, INDEX IDX_D8698A7612469DE2 (category_id), INDEX IDX_D8698A7671F7E88B (event_id), INDEX IDX_D8698A768DB60186 (task_id), INDEX IDX_D8698A76F395DB7B (expense_id), INDEX IDX_D8698A766BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, house_id INT DEFAULT NULL, responsable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, date_event DATETIME NOT NULL, date_end_event DATETIME DEFAULT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, INDEX IDX_3BAE0AA712469DE2 (category_id), INDEX IDX_3BAE0AA76BB74515 (house_id), INDEX IDX_3BAE0AA753C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, house_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, INDEX IDX_57698A6A6BB74515 (house_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_roommate (role_id INT NOT NULL, roommate_id INT NOT NULL, INDEX IDX_B2A83A26D60322AC (role_id), INDEX IDX_B2A83A26957252FA (roommate_id), PRIMARY KEY(role_id, roommate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, date_update DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7671F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A768DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76F395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA76BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA753C59D72 FOREIGN KEY (responsable_id) REFERENCES roommate (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A6BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE role_roommate ADD CONSTRAINT FK_B2A83A26D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_roommate ADD CONSTRAINT FK_B2A83A26957252FA FOREIGN KEY (roommate_id) REFERENCES roommate (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE category_expense');
        $this->addSql('DROP TABLE category_task');
        $this->addSql('DROP INDEX IDX_2D3A8DA6D58B8B05 ON expense');
        $this->addSql('ALTER TABLE expense ADD house_id INT DEFAULT NULL, ADD responsable_id INT DEFAULT NULL, ADD is_paid TINYINT(1) DEFAULT NULL, CHANGE category_expense_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA66BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA653C59D72 FOREIGN KEY (responsable_id) REFERENCES roommate (id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA612469DE2 ON expense (category_id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA66BB74515 ON expense (house_id)');
        $this->addSql('CREATE INDEX IDX_2D3A8DA653C59D72 ON expense (responsable_id)');
        $this->addSql('ALTER TABLE roommate ADD user_id INT DEFAULT NULL, CHANGE date_update date_update DATETIME NOT NULL');
        $this->addSql('ALTER TABLE roommate ADD CONSTRAINT FK_987BDC17A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_987BDC17A76ED395 ON roommate (user_id)');
        $this->addSql('DROP INDEX IDX_527EDB254A6E41F8 ON task');
        $this->addSql('ALTER TABLE task ADD responsable_id INT DEFAULT NULL, ADD house_id INT DEFAULT NULL, ADD is_done TINYINT(1) DEFAULT NULL, ADD type_task VARCHAR(255) DEFAULT NULL, CHANGE category_task_id category_id INT DEFAULT NULL, CHANGE date_due date_task DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2553C59D72 FOREIGN KEY (responsable_id) REFERENCES roommate (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('CREATE INDEX IDX_527EDB2512469DE2 ON task (category_id)');
        $this->addSql('CREATE INDEX IDX_527EDB2553C59D72 ON task (responsable_id)');
        $this->addSql('CREATE INDEX IDX_527EDB256BB74515 ON task (house_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA612469DE2');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2512469DE2');
        $this->addSql('ALTER TABLE roommate DROP FOREIGN KEY FK_987BDC17A76ED395');
        $this->addSql('CREATE TABLE category_expense (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_task (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7612469DE2');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7671F7E88B');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A768DB60186');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76F395DB7B');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A766BB74515');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA76BB74515');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA753C59D72');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A6BB74515');
        $this->addSql('ALTER TABLE role_roommate DROP FOREIGN KEY FK_B2A83A26D60322AC');
        $this->addSql('ALTER TABLE role_roommate DROP FOREIGN KEY FK_B2A83A26957252FA');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_roommate');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_987BDC17A76ED395 ON roommate');
        $this->addSql('ALTER TABLE roommate DROP user_id, CHANGE date_update date_update DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA66BB74515');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA653C59D72');
        $this->addSql('DROP INDEX IDX_2D3A8DA612469DE2 ON expense');
        $this->addSql('DROP INDEX IDX_2D3A8DA66BB74515 ON expense');
        $this->addSql('DROP INDEX IDX_2D3A8DA653C59D72 ON expense');
        $this->addSql('ALTER TABLE expense ADD category_expense_id INT DEFAULT NULL, DROP category_id, DROP house_id, DROP responsable_id, DROP is_paid');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA6D58B8B05 FOREIGN KEY (category_expense_id) REFERENCES category_expense (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2D3A8DA6D58B8B05 ON expense (category_expense_id)');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2553C59D72');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256BB74515');
        $this->addSql('DROP INDEX IDX_527EDB2512469DE2 ON task');
        $this->addSql('DROP INDEX IDX_527EDB2553C59D72 ON task');
        $this->addSql('DROP INDEX IDX_527EDB256BB74515 ON task');
        $this->addSql('ALTER TABLE task ADD category_task_id INT DEFAULT NULL, DROP category_id, DROP responsable_id, DROP house_id, DROP is_done, DROP type_task, CHANGE date_task date_due DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB254A6E41F8 FOREIGN KEY (category_task_id) REFERENCES category_task (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_527EDB254A6E41F8 ON task (category_task_id)');
    }
}
