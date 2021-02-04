<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204112415 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bottle ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE bottle ADD CONSTRAINT FK_ACA9A955C54C8C93 FOREIGN KEY (type_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_ACA9A955C54C8C93 ON bottle (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bottle DROP FOREIGN KEY FK_ACA9A955C54C8C93');
        $this->addSql('DROP INDEX IDX_ACA9A955C54C8C93 ON bottle');
        $this->addSql('ALTER TABLE bottle DROP type_id');
    }
}
