<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190505122642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subscribed_category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(35) NOT NULL');
        $this->addSql('ALTER TABLE event DROP category');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA712469DE2 ON event (category_id)');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE passwordResetToken passwordResetToken VARCHAR(255) DEFAULT NULL, CHANGE first_name first_name VARCHAR(64) NOT NULL, CHANGE last_name last_name VARCHAR(64) NOT NULL, CHANGE username username VARCHAR(32) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE subscribed_category');
        $this->addSql('ALTER TABLE category CHANGE name name TEXT NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7F675F31B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712469DE2');
        $this->addSql('DROP INDEX IDX_3BAE0AA712469DE2 ON event');
        $this->addSql('ALTER TABLE event ADD category VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE email email TEXT NOT NULL COLLATE latin1_swedish_ci, CHANGE roles roles TEXT NOT NULL COLLATE latin1_swedish_ci, CHANGE password password TEXT NOT NULL COLLATE latin1_swedish_ci, CHANGE passwordResetToken passwordResetToken TEXT DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE first_name first_name TEXT NOT NULL COLLATE latin1_swedish_ci, CHANGE last_name last_name TEXT NOT NULL COLLATE latin1_swedish_ci, CHANGE username username TEXT NOT NULL COLLATE latin1_swedish_ci');
    }
}
