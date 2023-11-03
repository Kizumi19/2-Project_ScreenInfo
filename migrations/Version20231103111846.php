<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231103111846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE speciality_doctor (speciality_id INTEGER NOT NULL, doctor_id INTEGER NOT NULL, PRIMARY KEY(speciality_id, doctor_id), CONSTRAINT FK_88C08EA83B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_88C08EA887F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_88C08EA83B5A08D7 ON speciality_doctor (speciality_id)');
        $this->addSql('CREATE INDEX IDX_88C08EA887F4FB17 ON speciality_doctor (doctor_id)');
        $this->addSql('DROP TABLE doctor_speciality');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doctor_speciality (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, doctor_id INTEGER DEFAULT NULL, speciality_id INTEGER DEFAULT NULL, hidden DATETIME DEFAULT NULL, CONSTRAINT FK_C4C0891F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C4C0891F3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C4C0891F3B5A08D7 ON doctor_speciality (speciality_id)');
        $this->addSql('CREATE INDEX IDX_C4C0891F87F4FB17 ON doctor_speciality (doctor_id)');
        $this->addSql('DROP TABLE speciality_doctor');
    }
}
