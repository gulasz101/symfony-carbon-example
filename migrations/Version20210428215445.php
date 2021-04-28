<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210428215445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tracking AS SELECT id, tracking_number, created_at, updated_at FROM tracking');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('CREATE TABLE tracking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tracking_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME(6) NOT NULL --(DC2Type:carbon)
        , updated_at DATETIME(6) NOT NULL --(DC2Type:carbon)
        )');
        $this->addSql('INSERT INTO tracking (id, tracking_number, created_at, updated_at) SELECT id, tracking_number, created_at, updated_at FROM __temp__tracking');
        $this->addSql('DROP TABLE __temp__tracking');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__tracking AS SELECT id, tracking_number, created_at, updated_at FROM tracking');
        $this->addSql('DROP TABLE tracking');
        $this->addSql('CREATE TABLE tracking (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tracking_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO tracking (id, tracking_number, created_at, updated_at) SELECT id, tracking_number, created_at, updated_at FROM __temp__tracking');
        $this->addSql('DROP TABLE __temp__tracking');
    }
}
