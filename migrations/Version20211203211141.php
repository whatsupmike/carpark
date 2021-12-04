<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203211141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE office_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE office (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE zone ADD office_id INT NOT NULL');
        $this->addSql('ALTER TABLE zone ADD CONSTRAINT FK_A0EBC007FFA0C224 FOREIGN KEY (office_id) REFERENCES office (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A0EBC007FFA0C224 ON zone (office_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zone DROP CONSTRAINT FK_A0EBC007FFA0C224');
        $this->addSql('DROP SEQUENCE office_id_seq CASCADE');
        $this->addSql('DROP TABLE office');
        $this->addSql('DROP INDEX IDX_A0EBC007FFA0C224');
        $this->addSql('ALTER TABLE zone DROP office_id');
    }
}
