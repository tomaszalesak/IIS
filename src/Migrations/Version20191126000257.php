<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126000257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE turnaj_tym (turnaj_id INT NOT NULL, tym_id INT NOT NULL, INDEX IDX_8EA2D96A8F36E313 (turnaj_id), INDEX IDX_8EA2D96A85FF5F36 (tym_id), PRIMARY KEY(turnaj_id, tym_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE turnaj_tym ADD CONSTRAINT FK_8EA2D96A8F36E313 FOREIGN KEY (turnaj_id) REFERENCES turnaj (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turnaj_tym ADD CONSTRAINT FK_8EA2D96A85FF5F36 FOREIGN KEY (tym_id) REFERENCES tym (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE turnaj ADD typ_id INT NOT NULL, ADD vedouci_id INT NOT NULL, ADD minimum_tymu INT NOT NULL, ADD maximum_tymu INT NOT NULL');
        $this->addSql('ALTER TABLE turnaj ADD CONSTRAINT FK_42BDDD56278CD074 FOREIGN KEY (typ_id) REFERENCES typ (id)');
        $this->addSql('ALTER TABLE turnaj ADD CONSTRAINT FK_42BDDD567D25FE4B FOREIGN KEY (vedouci_id) REFERENCES uzivatel (id)');
        $this->addSql('CREATE INDEX IDX_42BDDD56278CD074 ON turnaj (typ_id)');
        $this->addSql('CREATE INDEX IDX_42BDDD567D25FE4B ON turnaj (vedouci_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE turnaj_tym');
        $this->addSql('ALTER TABLE turnaj DROP FOREIGN KEY FK_42BDDD56278CD074');
        $this->addSql('ALTER TABLE turnaj DROP FOREIGN KEY FK_42BDDD567D25FE4B');
        $this->addSql('DROP INDEX IDX_42BDDD56278CD074 ON turnaj');
        $this->addSql('DROP INDEX IDX_42BDDD567D25FE4B ON turnaj');
        $this->addSql('ALTER TABLE turnaj DROP typ_id, DROP vedouci_id, DROP minimum_tymu, DROP maximum_tymu');
    }
}
