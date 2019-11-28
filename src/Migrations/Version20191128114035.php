<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191128114035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE turnaj_uzivatel (turnaj_id INT NOT NULL, uzivatel_id INT NOT NULL, INDEX IDX_ADADFD288F36E313 (turnaj_id), INDEX IDX_ADADFD289B3651C6 (uzivatel_id), PRIMARY KEY(turnaj_id, uzivatel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utkani (id INT AUTO_INCREMENT NOT NULL, hoste_id INT DEFAULT NULL, domaci_id INT DEFAULT NULL, INDEX IDX_8C5D351EFCE7A18 (hoste_id), INDEX IDX_8C5D351EC6382EFD (domaci_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE turnaj_uzivatel ADD CONSTRAINT FK_ADADFD288F36E313 FOREIGN KEY (turnaj_id) REFERENCES turnaj (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turnaj_uzivatel ADD CONSTRAINT FK_ADADFD289B3651C6 FOREIGN KEY (uzivatel_id) REFERENCES uzivatel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351EFCE7A18 FOREIGN KEY (hoste_id) REFERENCES tym (id)');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351EC6382EFD FOREIGN KEY (domaci_id) REFERENCES tym (id)');
        $this->addSql('ALTER TABLE turnaj ADD pocet_tymu INT NOT NULL, DROP minimum_tymu, DROP maximum_tymu');
        $this->addSql('ALTER TABLE uzivatel ADD je_rozhodci INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE turnaj_uzivatel');
        $this->addSql('DROP TABLE utkani');
        $this->addSql('ALTER TABLE turnaj ADD maximum_tymu INT NOT NULL, CHANGE pocet_tymu minimum_tymu INT NOT NULL');
        $this->addSql('ALTER TABLE uzivatel DROP je_rozhodci');
    }
}
