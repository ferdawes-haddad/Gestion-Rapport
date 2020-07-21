<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200721111056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C9E225B24');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96577906E4');
        $this->addSql('CREATE TABLE soutenance (id INT AUTO_INCREMENT NOT NULL, enseignants_id INT DEFAULT NULL, date DATE NOT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_4D59FF6E7CF12A69 (enseignants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soutenance ADD CONSTRAINT FK_4D59FF6E7CF12A69 FOREIGN KEY (enseignants_id) REFERENCES enseignant (id)');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE section');
        $this->addSql('ALTER TABLE admin ADD document VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_BE34A09C9E225B24 ON rapport');
        $this->addSql('ALTER TABLE rapport ADD classe VARCHAR(255) NOT NULL, ADD section VARCHAR(255) NOT NULL, DROP classes_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, sections_id INT DEFAULT NULL, classe INT NOT NULL, INDEX IDX_8F87BF96577906E4 (sections_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, section VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96577906E4 FOREIGN KEY (sections_id) REFERENCES section (id)');
        $this->addSql('DROP TABLE soutenance');
        $this->addSql('ALTER TABLE admin DROP document');
        $this->addSql('ALTER TABLE rapport ADD classes_id INT DEFAULT NULL, DROP classe, DROP section');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C9E225B24 FOREIGN KEY (classes_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C9E225B24 ON rapport (classes_id)');
    }
}
