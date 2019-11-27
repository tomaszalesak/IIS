<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123012722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tym_uzivatel (tym_id INT NOT NULL, uzivatel_id INT NOT NULL, INDEX IDX_2929A8E285FF5F36 (tym_id), INDEX IDX_2929A8E29B3651C6 (uzivatel_id), PRIMARY KEY(tym_id, uzivatel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tym_uzivatel ADD CONSTRAINT FK_2929A8E285FF5F36 FOREIGN KEY (tym_id) REFERENCES tym (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tym_uzivatel ADD CONSTRAINT FK_2929A8E29B3651C6 FOREIGN KEY (uzivatel_id) REFERENCES uzivatel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tym_uzivatel');
    }
}
