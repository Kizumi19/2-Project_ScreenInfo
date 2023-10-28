<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231028092507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doctor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, hidden DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE doctor_speciality (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, doctor_id INTEGER DEFAULT NULL, speciality_id INTEGER DEFAULT NULL, hidden DATETIME DEFAULT NULL, CONSTRAINT FK_C4C0891F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C4C0891F3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C4C0891F87F4FB17 ON doctor_speciality (doctor_id)');
        $this->addSql('CREATE INDEX IDX_C4C0891F3B5A08D7 ON doctor_speciality (speciality_id)');
        $this->addSql('CREATE TABLE location (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, floor INTEGER NOT NULL, room INTEGER NOT NULL, hidden DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE schedule (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, doctor_id INTEGER DEFAULT NULL, location_id INTEGER DEFAULT NULL, day VARCHAR(255) NOT NULL, shift VARCHAR(255) NOT NULL, hidden DATETIME DEFAULT NULL, CONSTRAINT FK_5A3811FB87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5A3811FB64D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5A3811FB87F4FB17 ON schedule (doctor_id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB64D218E ON schedule (location_id)');
        $this->addSql('CREATE TABLE speciality (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_speciality VARCHAR(255) NOT NULL, hidden DATETIME DEFAULT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE doctor_speciality');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
