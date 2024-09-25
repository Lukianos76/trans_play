<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240914102655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE files_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mod_files_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE files (id INT NOT NULL, uuid VARCHAR(255) NOT NULL, original_name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mod_files (id INT NOT NULL, mod_id INT NOT NULL, file_id INT NOT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8A5DA338E21CD ON mod_files (mod_id)');
        $this->addSql('CREATE INDEX IDX_D8A5DA93CB796C ON mod_files (file_id)');
        $this->addSql('ALTER TABLE mod_files ADD CONSTRAINT FK_D8A5DA338E21CD FOREIGN KEY (mod_id) REFERENCES mods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mod_files ADD CONSTRAINT FK_D8A5DA93CB796C FOREIGN KEY (file_id) REFERENCES files (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE mods ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE mods ALTER version DROP NOT NULL');
        $this->addSql('ALTER TABLE mods ALTER version TYPE VARCHAR(25)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE files_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mod_files_id_seq CASCADE');
        $this->addSql('ALTER TABLE mod_files DROP CONSTRAINT FK_D8A5DA338E21CD');
        $this->addSql('ALTER TABLE mod_files DROP CONSTRAINT FK_D8A5DA93CB796C');
        $this->addSql('DROP TABLE files');
        $this->addSql('DROP TABLE mod_files');
        $this->addSql('ALTER TABLE mods ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE mods ALTER version SET NOT NULL');
        $this->addSql('ALTER TABLE mods ALTER version TYPE VARCHAR(255)');
    }
}
