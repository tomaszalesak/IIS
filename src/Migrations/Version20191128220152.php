<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191128220152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utkani ADD turnaj_id INT NOT NULL');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351E8F36E313 FOREIGN KEY (turnaj_id) REFERENCES turnaj (id)');
        $this->addSql('CREATE INDEX IDX_8C5D351E8F36E313 ON utkani (turnaj_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utkani DROP FOREIGN KEY FK_8C5D351E8F36E313');
        $this->addSql('DROP INDEX IDX_8C5D351E8F36E313 ON utkani');
        $this->addSql('ALTER TABLE utkani DROP turnaj_id');
    }
}
