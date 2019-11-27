<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126224450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE utkani_uzivatel');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE utkani_uzivatel (utkani_id INT NOT NULL, uzivatel_id INT NOT NULL, INDEX IDX_B090BB30C712A439 (utkani_id), INDEX IDX_B090BB309B3651C6 (uzivatel_id), PRIMARY KEY(utkani_id, uzivatel_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utkani_uzivatel ADD CONSTRAINT FK_B090BB309B3651C6 FOREIGN KEY (uzivatel_id) REFERENCES uzivatel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utkani_uzivatel ADD CONSTRAINT FK_B090BB30C712A439 FOREIGN KEY (utkani_id) REFERENCES utkani (id) ON DELETE CASCADE');
    }
}
