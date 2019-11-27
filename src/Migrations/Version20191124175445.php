<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191124175445 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tym ADD vedouci_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tym ADD CONSTRAINT FK_6147C6C47D25FE4B FOREIGN KEY (vedouci_id) REFERENCES uzivatel (id)');
        $this->addSql('CREATE INDEX IDX_6147C6C47D25FE4B ON tym (vedouci_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tym DROP FOREIGN KEY FK_6147C6C47D25FE4B');
        $this->addSql('DROP INDEX IDX_6147C6C47D25FE4B ON tym');
        $this->addSql('ALTER TABLE tym DROP vedouci_id');
    }
}
