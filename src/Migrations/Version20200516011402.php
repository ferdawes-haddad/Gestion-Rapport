<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516011402 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA178D3A24C');
        $this->addSql('DROP INDEX IDX_81A72FA178D3A24C ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP rapports_id');
        $this->addSql('ALTER TABLE rapport ADD enseignants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C7CF12A69 FOREIGN KEY (enseignants_id) REFERENCES enseignant (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C7CF12A69 ON rapport (enseignants_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE enseignant ADD rapports_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA178D3A24C FOREIGN KEY (rapports_id) REFERENCES rapport (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA178D3A24C ON enseignant (rapports_id)');
        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C7CF12A69');
        $this->addSql('DROP INDEX IDX_BE34A09C7CF12A69 ON rapport');
        $this->addSql('ALTER TABLE rapport DROP enseignants_id');
    }
}
