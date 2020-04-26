<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426033933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, sections_id INT DEFAULT NULL, classe INT NOT NULL, INDEX IDX_8F87BF96577906E4 (sections_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport (id INT AUTO_INCREMENT NOT NULL, enseignants_id INT DEFAULT NULL, etudiants_id INT DEFAULT NULL, classe_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, note INT NOT NULL, INDEX IDX_BE34A09C7CF12A69 (enseignants_id), INDEX IDX_BE34A09CA873A5C6 (etudiants_id), INDEX IDX_BE34A09C8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, section VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96577906E4 FOREIGN KEY (sections_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C7CF12A69 FOREIGN KEY (enseignants_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09CA873A5C6 FOREIGN KEY (etudiants_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE enseignant ADD adminenseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1C74F3C84 FOREIGN KEY (adminenseignant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1C74F3C84 ON enseignant (adminenseignant_id)');
        $this->addSql('ALTER TABLE etudiant ADD adminetudiant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3769FE75E FOREIGN KEY (adminetudiant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3769FE75E ON etudiant (adminetudiant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C8F5EA509');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96577906E4');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE rapport');
        $this->addSql('DROP TABLE section');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1C74F3C84');
        $this->addSql('DROP INDEX IDX_81A72FA1C74F3C84 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP adminenseignant_id');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3769FE75E');
        $this->addSql('DROP INDEX IDX_717E22E3769FE75E ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP adminetudiant_id');
    }
}
