<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204081006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'modification de datetime en date';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bottle CHANGE misebout misebout DATE NOT NULL, CHANGE createat createat DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bottle CHANGE misebout misebout DATETIME NOT NULL, CHANGE createat createat DATETIME NOT NULL');
    }
}
