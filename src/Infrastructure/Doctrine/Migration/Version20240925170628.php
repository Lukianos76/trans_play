<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925170628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mods ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mods ADD CONSTRAINT FK_631EF2FAE48FD905 FOREIGN KEY (game_id) REFERENCES games (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_631EF2FAE48FD905 ON mods (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE mods DROP CONSTRAINT FK_631EF2FAE48FD905');
        $this->addSql('DROP INDEX IDX_631EF2FAE48FD905');
        $this->addSql('ALTER TABLE mods DROP game_id');
    }
}
