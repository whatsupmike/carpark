<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203191831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sts_employee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE zone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_place (id INT NOT NULL, employee_id INT NOT NULL, place_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9C105EB48C03F15C ON employee_place (employee_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9C105EB4DA6A219 ON employee_place (place_id)');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, zone_id INT NOT NULL, x_coordinate INT NOT NULL, y_coordinate INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_741D53CD9F2C3FAB ON place (zone_id)');
        $this->addSql('CREATE TABLE place_reservation (id INT NOT NULL, place_id INT NOT NULL, employee_id INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C3D01F1DA6A219 ON place_reservation (place_id)');
        $this->addSql('CREATE INDEX IDX_4C3D01F18C03F15C ON place_reservation (employee_id)');
        $this->addSql('CREATE TABLE sts_employee (id INT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE zone (id INT NOT NULL, columns_count INT NOT NULL, rows_count INT NOT NULL, name VARCHAR(255) NOT NULL, grid TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN zone.grid IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE employee_place ADD CONSTRAINT FK_9C105EB48C03F15C FOREIGN KEY (employee_id) REFERENCES sts_employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_place ADD CONSTRAINT FK_9C105EB4DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place_reservation ADD CONSTRAINT FK_4C3D01F1DA6A219 FOREIGN KEY (place_id) REFERENCES place (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place_reservation ADD CONSTRAINT FK_4C3D01F18C03F15C FOREIGN KEY (employee_id) REFERENCES sts_employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_place DROP CONSTRAINT FK_9C105EB4DA6A219');
        $this->addSql('ALTER TABLE place_reservation DROP CONSTRAINT FK_4C3D01F1DA6A219');
        $this->addSql('ALTER TABLE employee_place DROP CONSTRAINT FK_9C105EB48C03F15C');
        $this->addSql('ALTER TABLE place_reservation DROP CONSTRAINT FK_4C3D01F18C03F15C');
        $this->addSql('ALTER TABLE place DROP CONSTRAINT FK_741D53CD9F2C3FAB');
        $this->addSql('DROP SEQUENCE employee_place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sts_employee_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE zone_id_seq CASCADE');
        $this->addSql('DROP TABLE employee_place');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE place_reservation');
        $this->addSql('DROP TABLE sts_employee');
        $this->addSql('DROP TABLE zone');
    }
}
