<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402150222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, admin_id INT NOT NULL, title VARCHAR(255) NOT NULL, image LONGBLOB DEFAULT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_23A0E66642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, admin_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, image LONGBLOB DEFAULT NULL, location VARCHAR(255) NOT NULL, point INT NOT NULL, progession INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D7098951613FECDF (session_id), INDEX IDX_D7098951642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, state LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', score INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_challenge (group_id INT NOT NULL, challenge_id INT NOT NULL, INDEX IDX_17BAD5B0FE54D947 (group_id), INDEX IDX_17BAD5B098A21AC6 (challenge_id), PRIMARY KEY(group_id, challenge_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, admin_id INT NOT NULL, name VARCHAR(30) NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, state LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D044D5D4642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, groups_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(30) NOT NULL, firstname VARCHAR(30) NOT NULL, gender VARCHAR(5) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, zip VARCHAR(10) NOT NULL, country VARCHAR(50) NOT NULL, phone VARCHAR(10) NOT NULL, dateofbirth DATE NOT NULL, remember_token VARCHAR(255) NOT NULL, reset_token VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, create_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649F373DCF (groups_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE group_challenge ADD CONSTRAINT FK_17BAD5B0FE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_challenge ADD CONSTRAINT FK_17BAD5B098A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F373DCF FOREIGN KEY (groups_id) REFERENCES `group` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66642B8210');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951642B8210');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4642B8210');
        $this->addSql('ALTER TABLE group_challenge DROP FOREIGN KEY FK_17BAD5B098A21AC6');
        $this->addSql('ALTER TABLE group_challenge DROP FOREIGN KEY FK_17BAD5B0FE54D947');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F373DCF');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951613FECDF');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE group_challenge');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
    }
}
