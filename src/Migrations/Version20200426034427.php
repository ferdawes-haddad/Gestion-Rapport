<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426034427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76769FE75E');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76C74F3C84');
        $this->addSql('DROP INDEX IDX_880E0D76C74F3C84 ON admin');
        $this->addSql('DROP INDEX IDX_880E0D76769FE75E ON admin');
        $this->addSql('ALTER TABLE admin ADD etudiant_id INT DEFAULT NULL, ADD enseignant_id INT DEFAULT NULL, DROP adminetudiant_id, DROP adminenseignant_id');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76DDEAB1A3 ON admin (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_880E0D76E455FCC0 ON admin (enseignant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76DDEAB1A3');
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76E455FCC0');
        $this->addSql('DROP INDEX IDX_880E0D76DDEAB1A3 ON admin');
        $this->addSql('DROP INDEX IDX_880E0D76E455FCC0 ON admin');
        $this->addSql('ALTER TABLE admin ADD adminetudiant_id INT DEFAULT NULL, ADD adminenseignant_id INT DEFAULT NULL, DROP etudiant_id, DROP enseignant_id');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76769FE75E FOREIGN KEY (adminetudiant_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76C74F3C84 FOREIGN KEY (adminenseignant_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_880E0D76C74F3C84 ON admin (adminenseignant_id)');
        $this->addSql('CREATE INDEX IDX_880E0D76769FE75E ON admin (adminetudiant_id)');
    }
}
