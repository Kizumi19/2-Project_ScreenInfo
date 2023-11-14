<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114082739 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__schedule AS SELECT id, location_id, day, shift, hidden FROM schedule');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('CREATE TABLE schedule (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER DEFAULT NULL, doctor_id INTEGER DEFAULT NULL, day CLOB NOT NULL --(DC2Type:json)
        , shift CLOB NOT NULL --(DC2Type:json)
        , hidden DATETIME DEFAULT NULL, CONSTRAINT FK_5A3811FB64D218E FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5A3811FB87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO schedule (id, location_id, day, shift, hidden) SELECT id, location_id, day, shift, hidden FROM __temp__schedule');
        $this->addSql('DROP TABLE __temp__schedule');
        $this->addSql('CREATE INDEX IDX_5A3811FB64D218E ON schedule (location_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB87F4FB17 ON schedule (doctor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__schedule AS SELECT id, location_id, day, shift, hidden FROM schedule');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('CREATE TABLE schedule (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER DEFAULT NULL, day CLOB NOT NULL --(DC2Type:json)
        , shift CLOB NOT NULL --(DC2Type:json)
        , hidden DATETIME DEFAULT NULL, CONSTRAINT FK_5A3811FB64D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO schedule (id, location_id, day, shift, hidden) SELECT id, location_id, day, shift, hidden FROM __temp__schedule');
        $this->addSql('DROP TABLE __temp__schedule');
        $this->addSql('CREATE INDEX IDX_5A3811FB64D218E ON schedule (location_id)');
    }
}
