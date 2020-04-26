<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426034251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin ADD adminetudiant_id INT DEFAULT NULL, ADD adminenseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76769FE75E FOREIGN KEY (adminetudiant_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76C74F3C84 FOREIGN KEY (adminenseignant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76769FE75E ON admin (adminetudiant_id)');
        $this->addSql('CREATE INDEX IDX_880E0D76C74F3C84 ON admin (adminenseignant_id)');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1C74F3C84');
        $this->addSql('DROP INDEX IDX_81A72FA1C74F3C84 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP adminenseignant_id');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3769FE75E');
        $this->addSql('DROP INDEX IDX_717E22E3769FE75E ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP adminetudiant_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76769FE75E');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76C74F3C84');
        $this->addSql('DROP INDEX IDX_880E0D76769FE75E ON admin');
        $this->addSql('DROP INDEX IDX_880E0D76C74F3C84 ON admin');
        $this->addSql('ALTER TABLE admin DROP adminetudiant_id, DROP adminenseignant_id');
        $this->addSql('ALTER TABLE enseignant ADD adminenseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1C74F3C84 FOREIGN KEY (adminenseignant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1C74F3C84 ON enseignant (adminenseignant_id)');
        $this->addSql('ALTER TABLE etudiant ADD adminetudiant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3769FE75E FOREIGN KEY (adminetudiant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3769FE75E ON etudiant (adminetudiant_id)');
    }
}
