<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211101092107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE class_spec ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE dungeon ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE npc ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE spell ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE class_spec DROP updated_at');
        $this->addSql('ALTER TABLE dungeon DROP updated_at');
        $this->addSql('ALTER TABLE npc DROP updated_at');
        $this->addSql('ALTER TABLE spell DROP updated_at');
    }
}
