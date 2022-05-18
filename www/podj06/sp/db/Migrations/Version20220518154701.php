<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518154701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE external_measurement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE housing_unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE external_measurement (id INT NOT NULL, housing_unit_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, unit VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, sensor_sn VARCHAR(255) DEFAULT NULL, company VARCHAR(255) NOT NULL, measured_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_44279566414013C5 ON external_measurement (housing_unit_id)');
        $this->addSql('CREATE TABLE housing_unit (id INT NOT NULL, user_id INT DEFAULT NULL, area DOUBLE PRECISION NOT NULL, number VARCHAR(255) NOT NULL, floor INT NOT NULL, votes_share INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9893734A76ED395 ON housing_unit (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password_hash VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('ALTER TABLE external_measurement ADD CONSTRAINT FK_44279566414013C5 FOREIGN KEY (housing_unit_id) REFERENCES housing_unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE housing_unit ADD CONSTRAINT FK_9893734A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE external_measurement DROP CONSTRAINT FK_44279566414013C5');
        $this->addSql('ALTER TABLE housing_unit DROP CONSTRAINT FK_9893734A76ED395');
        $this->addSql('DROP SEQUENCE external_measurement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE housing_unit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE external_measurement');
        $this->addSql('DROP TABLE housing_unit');
        $this->addSql('DROP TABLE "user"');
    }
}
