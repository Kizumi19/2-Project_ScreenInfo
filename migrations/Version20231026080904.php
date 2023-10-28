<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026080904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doctor_speciality (id INT AUTO_INCREMENT NOT NULL, doctor_id INT DEFAULT NULL, speciality_id INT DEFAULT NULL, hidden DATETIME DEFAULT NULL, INDEX IDX_C4C0891F87F4FB17 (doctor_id), INDEX IDX_C4C0891F3B5A08D7 (speciality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE doctor_speciality ADD CONSTRAINT FK_C4C0891F87F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE doctor_speciality ADD CONSTRAINT FK_C4C0891F3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor_speciality DROP FOREIGN KEY FK_C4C0891F87F4FB17');
        $this->addSql('ALTER TABLE doctor_speciality DROP FOREIGN KEY FK_C4C0891F3B5A08D7');
        $this->addSql('DROP TABLE doctor_speciality');
    }
}
