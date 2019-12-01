<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130123228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE statistiky_hrace (id INT AUTO_INCREMENT NOT NULL, utkani_id INT DEFAULT NULL, hrac_id INT DEFAULT NULL, dva_body INT DEFAULT NULL, tri_body INT DEFAULT NULL, fauly INT DEFAULT NULL, body INT DEFAULT NULL, INDEX IDX_7B333042C712A439 (utkani_id), INDEX IDX_7B333042771E6B04 (hrac_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistiky_hrace ADD CONSTRAINT FK_7B333042C712A439 FOREIGN KEY (utkani_id) REFERENCES utkani (id)');
        $this->addSql('ALTER TABLE statistiky_hrace ADD CONSTRAINT FK_7B333042771E6B04 FOREIGN KEY (hrac_id) REFERENCES uzivatel (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE statistiky_hrace');
    }
}
