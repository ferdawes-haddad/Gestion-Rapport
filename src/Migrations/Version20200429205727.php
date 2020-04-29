<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429205727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C8F5EA509');
        $this->addSql('DROP INDEX IDX_BE34A09C8F5EA509 ON rapport');
        $this->addSql('ALTER TABLE rapport CHANGE classe_id classes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C9E225B24 FOREIGN KEY (classes_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C9E225B24 ON rapport (classes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rapport DROP FOREIGN KEY FK_BE34A09C9E225B24');
        $this->addSql('DROP INDEX IDX_BE34A09C9E225B24 ON rapport');
        $this->addSql('ALTER TABLE rapport CHANGE classes_id classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rapport ADD CONSTRAINT FK_BE34A09C8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_BE34A09C8F5EA509 ON rapport (classe_id)');
    }
}
