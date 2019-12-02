<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202224900 extends AbstractMigration
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
        $this->addSql('CREATE TABLE turnaj (id INT AUTO_INCREMENT NOT NULL, typ_id INT NOT NULL, vedouci_id INT NOT NULL, nazev VARCHAR(255) NOT NULL, adresa VARCHAR(255) DEFAULT NULL, datum DATE NOT NULL, pocet_tymu INT NOT NULL, popis TEXT DEFAULT NULL, INDEX IDX_42BDDD56278CD074 (typ_id), INDEX IDX_42BDDD567D25FE4B (vedouci_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turnaj_tym (turnaj_id INT NOT NULL, tym_id INT NOT NULL, INDEX IDX_8EA2D96A8F36E313 (turnaj_id), INDEX IDX_8EA2D96A85FF5F36 (tym_id), PRIMARY KEY(turnaj_id, tym_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE turnaj_uzivatel (turnaj_id INT NOT NULL, uzivatel_id INT NOT NULL, INDEX IDX_ADADFD288F36E313 (turnaj_id), INDEX IDX_ADADFD289B3651C6 (uzivatel_id), PRIMARY KEY(turnaj_id, uzivatel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tym (id INT AUTO_INCREMENT NOT NULL, typ_id INT NOT NULL, vedouci_id INT DEFAULT NULL, jmeno VARCHAR(255) NOT NULL, popis TEXT DEFAULT NULL, adresa VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_6147C6C4278CD074 (typ_id), INDEX IDX_6147C6C47D25FE4B (vedouci_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tym_uzivatel (tym_id INT NOT NULL, uzivatel_id INT NOT NULL, INDEX IDX_2929A8E285FF5F36 (tym_id), INDEX IDX_2929A8E29B3651C6 (uzivatel_id), PRIMARY KEY(tym_id, uzivatel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typ (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(255) NOT NULL, pocet_clenu_tymu INT NOT NULL, min_pocet_clenu INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utkani (id INT AUTO_INCREMENT NOT NULL, hoste_id INT DEFAULT NULL, domaci_id INT DEFAULT NULL, turnaj_id INT NOT NULL, vyherce_id INT DEFAULT NULL, kolo INT DEFAULT NULL, cislo_utkani INT NOT NULL, domaci_body INT DEFAULT NULL, hoste_body INT DEFAULT NULL, INDEX IDX_8C5D351EFCE7A18 (hoste_id), INDEX IDX_8C5D351EC6382EFD (domaci_id), INDEX IDX_8C5D351E8F36E313 (turnaj_id), INDEX IDX_8C5D351E93DD8A2F (vyherce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uzivatel (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, jmeno VARCHAR(255) NOT NULL, prijmeni VARCHAR(255) NOT NULL, datum_narozeni DATE NOT NULL, je_rozhodci INT DEFAULT NULL, UNIQUE INDEX UNIQ_1C0F667EF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistiky_hrace ADD CONSTRAINT FK_7B333042C712A439 FOREIGN KEY (utkani_id) REFERENCES utkani (id)');
        $this->addSql('ALTER TABLE statistiky_hrace ADD CONSTRAINT FK_7B333042771E6B04 FOREIGN KEY (hrac_id) REFERENCES uzivatel (id)');
        $this->addSql('ALTER TABLE turnaj ADD CONSTRAINT FK_42BDDD56278CD074 FOREIGN KEY (typ_id) REFERENCES typ (id)');
        $this->addSql('ALTER TABLE turnaj ADD CONSTRAINT FK_42BDDD567D25FE4B FOREIGN KEY (vedouci_id) REFERENCES uzivatel (id)');
        $this->addSql('ALTER TABLE turnaj_tym ADD CONSTRAINT FK_8EA2D96A8F36E313 FOREIGN KEY (turnaj_id) REFERENCES turnaj (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turnaj_tym ADD CONSTRAINT FK_8EA2D96A85FF5F36 FOREIGN KEY (tym_id) REFERENCES tym (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turnaj_uzivatel ADD CONSTRAINT FK_ADADFD288F36E313 FOREIGN KEY (turnaj_id) REFERENCES turnaj (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turnaj_uzivatel ADD CONSTRAINT FK_ADADFD289B3651C6 FOREIGN KEY (uzivatel_id) REFERENCES uzivatel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tym ADD CONSTRAINT FK_6147C6C4278CD074 FOREIGN KEY (typ_id) REFERENCES typ (id)');
        $this->addSql('ALTER TABLE tym ADD CONSTRAINT FK_6147C6C47D25FE4B FOREIGN KEY (vedouci_id) REFERENCES uzivatel (id)');
        $this->addSql('ALTER TABLE tym_uzivatel ADD CONSTRAINT FK_2929A8E285FF5F36 FOREIGN KEY (tym_id) REFERENCES tym (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tym_uzivatel ADD CONSTRAINT FK_2929A8E29B3651C6 FOREIGN KEY (uzivatel_id) REFERENCES uzivatel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351EFCE7A18 FOREIGN KEY (hoste_id) REFERENCES tym (id)');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351EC6382EFD FOREIGN KEY (domaci_id) REFERENCES tym (id)');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351E8F36E313 FOREIGN KEY (turnaj_id) REFERENCES turnaj (id)');
        $this->addSql('ALTER TABLE utkani ADD CONSTRAINT FK_8C5D351E93DD8A2F FOREIGN KEY (vyherce_id) REFERENCES tym (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE turnaj_tym DROP FOREIGN KEY FK_8EA2D96A8F36E313');
        $this->addSql('ALTER TABLE turnaj_uzivatel DROP FOREIGN KEY FK_ADADFD288F36E313');
        $this->addSql('ALTER TABLE utkani DROP FOREIGN KEY FK_8C5D351E8F36E313');
        $this->addSql('ALTER TABLE turnaj_tym DROP FOREIGN KEY FK_8EA2D96A85FF5F36');
        $this->addSql('ALTER TABLE tym_uzivatel DROP FOREIGN KEY FK_2929A8E285FF5F36');
        $this->addSql('ALTER TABLE utkani DROP FOREIGN KEY FK_8C5D351EFCE7A18');
        $this->addSql('ALTER TABLE utkani DROP FOREIGN KEY FK_8C5D351EC6382EFD');
        $this->addSql('ALTER TABLE utkani DROP FOREIGN KEY FK_8C5D351E93DD8A2F');
        $this->addSql('ALTER TABLE turnaj DROP FOREIGN KEY FK_42BDDD56278CD074');
        $this->addSql('ALTER TABLE tym DROP FOREIGN KEY FK_6147C6C4278CD074');
        $this->addSql('ALTER TABLE statistiky_hrace DROP FOREIGN KEY FK_7B333042C712A439');
        $this->addSql('ALTER TABLE statistiky_hrace DROP FOREIGN KEY FK_7B333042771E6B04');
        $this->addSql('ALTER TABLE turnaj DROP FOREIGN KEY FK_42BDDD567D25FE4B');
        $this->addSql('ALTER TABLE turnaj_uzivatel DROP FOREIGN KEY FK_ADADFD289B3651C6');
        $this->addSql('ALTER TABLE tym DROP FOREIGN KEY FK_6147C6C47D25FE4B');
        $this->addSql('ALTER TABLE tym_uzivatel DROP FOREIGN KEY FK_2929A8E29B3651C6');
        $this->addSql('DROP TABLE statistiky_hrace');
        $this->addSql('DROP TABLE turnaj');
        $this->addSql('DROP TABLE turnaj_tym');
        $this->addSql('DROP TABLE turnaj_uzivatel');
        $this->addSql('DROP TABLE tym');
        $this->addSql('DROP TABLE tym_uzivatel');
        $this->addSql('DROP TABLE typ');
        $this->addSql('DROP TABLE utkani');
        $this->addSql('DROP TABLE uzivatel');
    }
}
