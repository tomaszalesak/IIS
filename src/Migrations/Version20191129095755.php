<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191129095755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utkani ADD vyherce_id INT DEFAULT NULL, ADD kolo INT DEFAULT NULL, ADD cislo_utkani INT NOT NULL');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351E93DD8A2F FOREIGN KEY (vyherce_id) REFERENCES tym (id)');
        $this->addSql('CREATE INDEX IDX_8C5D351E93DD8A2F ON utkani (vyherce_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utkani DROP FOREIGN KEY FK_8C5D351E93DD8A2F');
        $this->addSql('DROP INDEX IDX_8C5D351E93DD8A2F ON utkani');
        $this->addSql('ALTER TABLE utkani DROP vyherce_id, DROP kolo, DROP cislo_utkani');
    }
}
