<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620184709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE poll_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE poll_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_vote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE poll (id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(65535) NOT NULL, poll_type VARCHAR(255) NOT NULL, opened_from TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, opened_to TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_84BCFA45A76ED395 ON poll (user_id)');
        $this->addSql('CREATE TABLE poll_option (id INT NOT NULL, poll_id INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B68343EB3C947C0F ON poll_option (poll_id)');
        $this->addSql('CREATE TABLE user_vote (id INT NOT NULL, user_id INT NOT NULL, poll_option_id INT DEFAULT NULL, poll_id INT NOT NULL, free_option_text VARCHAR(65535) DEFAULT NULL, comment VARCHAR(65535) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2091C9ADA76ED395 ON user_vote (user_id)');
        $this->addSql('CREATE INDEX IDX_2091C9AD6C13349B ON user_vote (poll_option_id)');
        $this->addSql('CREATE INDEX IDX_2091C9AD3C947C0F ON user_vote (poll_id)');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA45A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE poll_option ADD CONSTRAINT FK_B68343EB3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_vote ADD CONSTRAINT FK_2091C9ADA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_vote ADD CONSTRAINT FK_2091C9AD6C13349B FOREIGN KEY (poll_option_id) REFERENCES poll_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_vote ADD CONSTRAINT FK_2091C9AD3C947C0F FOREIGN KEY (poll_id) REFERENCES poll (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE poll_option DROP CONSTRAINT FK_B68343EB3C947C0F');
        $this->addSql('ALTER TABLE user_vote DROP CONSTRAINT FK_2091C9AD3C947C0F');
        $this->addSql('ALTER TABLE user_vote DROP CONSTRAINT FK_2091C9AD6C13349B');
        $this->addSql('DROP SEQUENCE poll_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE poll_option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_vote_id_seq CASCADE');
        $this->addSql('DROP TABLE poll');
        $this->addSql('DROP TABLE poll_option');
        $this->addSql('DROP TABLE user_vote');
    }
}
