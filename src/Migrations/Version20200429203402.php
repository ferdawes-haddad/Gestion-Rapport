<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429203402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76DDEAB1A3');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76E455FCC0');
        $this->addSql('DROP INDEX IDX_880E0D76E455FCC0 ON admin');
        $this->addSql('DROP INDEX IDX_880E0D76DDEAB1A3 ON admin');
        $this->addSql('ALTER TABLE admin DROP etudiant_id, DROP enseignant_id');
        $this->addSql('ALTER TABLE enseignant ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA1642B8210 ON enseignant (admin_id)');
        $this->addSql('ALTER TABLE etudiant ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3642B8210 ON etudiant (admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin ADD etudiant_id INT DEFAULT NULL, ADD enseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76E455FCC0 ON admin (enseignant_id)');
        $this->addSql('CREATE INDEX IDX_880E0D76DDEAB1A3 ON admin (etudiant_id)');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1642B8210');
        $this->addSql('DROP INDEX IDX_81A72FA1642B8210 ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP admin_id');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3642B8210');
        $this->addSql('DROP INDEX IDX_717E22E3642B8210 ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP admin_id');
    }
}
