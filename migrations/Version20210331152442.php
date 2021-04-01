<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331152442 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, image LONGBLOB DEFAULT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, image LONGBLOB DEFAULT NULL, location VARCHAR(255) NOT NULL, point INT NOT NULL, progession INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, name VARCHAR(30) NOT NULL, state LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', score INT NOT NULL, INDEX IDX_6DC044C5613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_challenge (group_id INT NOT NULL, challenge_id INT NOT NULL, INDEX IDX_17BAD5B0FE54D947 (group_id), INDEX IDX_17BAD5B098A21AC6 (challenge_id), PRIMARY KEY(group_id, challenge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C5613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE group_challenge ADD CONSTRAINT FK_17BAD5B0FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_challenge ADD CONSTRAINT FK_17BAD5B098A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD groups_id INT DEFAULT NULL, ADD reset_token VARCHAR(255) NOT NULL, DROP created_at, DROP update_at');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F373DCF FOREIGN KEY (groups_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F373DCF ON user (groups_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE group_challenge DROP FOREIGN KEY FK_17BAD5B098A21AC6');
        $this->addSql('ALTER TABLE group_challenge DROP FOREIGN KEY FK_17BAD5B0FE54D947');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F373DCF');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE group_challenge');
        $this->addSql('DROP INDEX IDX_8D93D649F373DCF ON user');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL, ADD update_at DATETIME NOT NULL, DROP groups_id, DROP reset_token');
    }
}
