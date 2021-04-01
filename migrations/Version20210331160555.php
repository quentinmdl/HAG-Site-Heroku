<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331160555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66642B8210 ON article (admin_id)');
        $this->addSql('ALTER TABLE challenge ADD admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_D7098951642B8210 ON challenge (admin_id)');
        $this->addSql('ALTER TABLE session ADD admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D4642B8210 ON session (admin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66642B8210');
        $this->addSql('DROP INDEX IDX_23A0E66642B8210 ON article');
        $this->addSql('ALTER TABLE article DROP admin_id');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951642B8210');
        $this->addSql('DROP INDEX IDX_D7098951642B8210 ON challenge');
        $this->addSql('ALTER TABLE challenge DROP admin_id');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4642B8210');
        $this->addSql('DROP INDEX IDX_D044D5D4642B8210 ON session');
        $this->addSql('ALTER TABLE session DROP admin_id');
    }
}
