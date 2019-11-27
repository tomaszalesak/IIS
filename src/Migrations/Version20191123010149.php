<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123010149 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tym (id INT AUTO_INCREMENT NOT NULL, typ_id INT NOT NULL, jmeno VARCHAR(255) NOT NULL, INDEX IDX_6147C6C4278CD074 (typ_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typ (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(255) NOT NULL, pocet_clenu_tymu INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tym ADD CONSTRAINT FK_6147C6C4278CD074 FOREIGN KEY (typ_id) REFERENCES typ (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tym DROP FOREIGN KEY FK_6147C6C4278CD074');
        $this->addSql('DROP TABLE tym');
        $this->addSql('DROP TABLE typ');
    }
}
