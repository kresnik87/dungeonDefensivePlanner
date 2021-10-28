<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028112604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_spec (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dungeon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE npc (id INT AUTO_INCREMENT NOT NULL, dungeon_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, blizzard_id VARCHAR(255) DEFAULT NULL, href VARCHAR(255) DEFAULT NULL, INDEX IDX_468C762CB606863 (dungeon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell (id INT AUTO_INCREMENT NOT NULL, npc_id INT DEFAULT NULL, class_spec_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, href VARCHAR(255) DEFAULT NULL, blizzard_id VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_D03FCD8DCA7D6B89 (npc_id), INDEX IDX_D03FCD8D6FFAC307 (class_spec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategy (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, dungeon_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, visibility VARCHAR(255) DEFAULT NULL, INDEX IDX_144645ED7E3C61F9 (owner_id), INDEX IDX_144645EDB606863 (dungeon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategy_action (id INT AUTO_INCREMENT NOT NULL, strategy_id INT DEFAULT NULL, boss_spell_id INT DEFAULT NULL, deff_spell_id INT DEFAULT NULL, boss_id INT DEFAULT NULL, action INT DEFAULT NULL, INDEX IDX_8BD55A38D5CAD932 (strategy_id), INDEX IDX_8BD55A38CEF44844 (boss_spell_id), INDEX IDX_8BD55A389A005DDD (deff_spell_id), INDEX IDX_8BD55A38261FB672 (boss_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE npc ADD CONSTRAINT FK_468C762CB606863 FOREIGN KEY (dungeon_id) REFERENCES dungeon (id)');
        $this->addSql('ALTER TABLE spell ADD CONSTRAINT FK_D03FCD8DCA7D6B89 FOREIGN KEY (npc_id) REFERENCES npc (id)');
        $this->addSql('ALTER TABLE spell ADD CONSTRAINT FK_D03FCD8D6FFAC307 FOREIGN KEY (class_spec_id) REFERENCES class_spec (id)');
        $this->addSql('ALTER TABLE strategy ADD CONSTRAINT FK_144645ED7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE strategy ADD CONSTRAINT FK_144645EDB606863 FOREIGN KEY (dungeon_id) REFERENCES dungeon (id)');
        $this->addSql('ALTER TABLE strategy_action ADD CONSTRAINT FK_8BD55A38D5CAD932 FOREIGN KEY (strategy_id) REFERENCES strategy (id)');
        $this->addSql('ALTER TABLE strategy_action ADD CONSTRAINT FK_8BD55A38CEF44844 FOREIGN KEY (boss_spell_id) REFERENCES spell (id)');
        $this->addSql('ALTER TABLE strategy_action ADD CONSTRAINT FK_8BD55A389A005DDD FOREIGN KEY (deff_spell_id) REFERENCES spell (id)');
        $this->addSql('ALTER TABLE strategy_action ADD CONSTRAINT FK_8BD55A38261FB672 FOREIGN KEY (boss_id) REFERENCES npc (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spell DROP FOREIGN KEY FK_D03FCD8D6FFAC307');
        $this->addSql('ALTER TABLE npc DROP FOREIGN KEY FK_468C762CB606863');
        $this->addSql('ALTER TABLE strategy DROP FOREIGN KEY FK_144645EDB606863');
        $this->addSql('ALTER TABLE spell DROP FOREIGN KEY FK_D03FCD8DCA7D6B89');
        $this->addSql('ALTER TABLE strategy_action DROP FOREIGN KEY FK_8BD55A38261FB672');
        $this->addSql('ALTER TABLE strategy_action DROP FOREIGN KEY FK_8BD55A38CEF44844');
        $this->addSql('ALTER TABLE strategy_action DROP FOREIGN KEY FK_8BD55A389A005DDD');
        $this->addSql('ALTER TABLE strategy_action DROP FOREIGN KEY FK_8BD55A38D5CAD932');
        $this->addSql('ALTER TABLE strategy DROP FOREIGN KEY FK_144645ED7E3C61F9');
        $this->addSql('DROP TABLE class_spec');
        $this->addSql('DROP TABLE dungeon');
        $this->addSql('DROP TABLE npc');
        $this->addSql('DROP TABLE spell');
        $this->addSql('DROP TABLE strategy');
        $this->addSql('DROP TABLE strategy_action');
        $this->addSql('DROP TABLE user');
    }
}
