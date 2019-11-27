<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127000032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE utkani');
        $this->addSql('ALTER TABLE turnaj ADD rozhodci1_id INT DEFAULT NULL, ADD rozhodci2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE turnaj ADD CONSTRAINT FK_42BDDD56CBBFBCD8 FOREIGN KEY (rozhodci1_id) REFERENCES uzivatel (id)');
        $this->addSql('ALTER TABLE turnaj ADD CONSTRAINT FK_42BDDD56D90A1336 FOREIGN KEY (rozhodci2_id) REFERENCES uzivatel (id)');
        $this->addSql('CREATE INDEX IDX_42BDDD56CBBFBCD8 ON turnaj (rozhodci1_id)');
        $this->addSql('CREATE INDEX IDX_42BDDD56D90A1336 ON turnaj (rozhodci2_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE utkani (id INT AUTO_INCREMENT NOT NULL, hoste_id INT DEFAULT NULL, domaci_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_8C5D351EFCE7A18 (hoste_id), UNIQUE INDEX UNIQ_8C5D351EC6382EFD (domaci_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351EC6382EFD FOREIGN KEY (domaci_id) REFERENCES tym (id)');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351EFCE7A18 FOREIGN KEY (hoste_id) REFERENCES tym (id)');
        $this->addSql('ALTER TABLE turnaj DROP FOREIGN KEY FK_42BDDD56CBBFBCD8');
        $this->addSql('ALTER TABLE turnaj DROP FOREIGN KEY FK_42BDDD56D90A1336');
        $this->addSql('DROP INDEX IDX_42BDDD56CBBFBCD8 ON turnaj');
        $this->addSql('DROP INDEX IDX_42BDDD56D90A1336 ON turnaj');
        $this->addSql('ALTER TABLE turnaj DROP rozhodci1_id, DROP rozhodci2_id');
    }
}
