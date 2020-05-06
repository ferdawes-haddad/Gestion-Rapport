<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506042954 extends AbstractMigration
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
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09CA873A5C6');
        $this->addSql('DROP INDEX IDX_BE34A09CA873A5C6 ON rapport');
        $this->addSql('DROP INDEX IDX_BE34A09C9E225B24 ON rapport');
        $this->addSql('ALTER TABLE rapport DROP etudiants_id, DROP classes_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rapport ADD etudiants_id INT DEFAULT NULL, ADD classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C9E225B24 FOREIGN KEY (classes_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CA873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiant (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09CA873A5C6 ON rapport (etudiants_id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C9E225B24 ON rapport (classes_id)');
    }
}
