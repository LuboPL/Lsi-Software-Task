<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251219202352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS export_history (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, export_name VARCHAR(255) NOT NULL, exported_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', exported_by_username VARCHAR(255) NOT NULL, location_name VARCHAR(255) NOT NULL, INDEX idx_loc_date (location_name, exported_at), INDEX idx_date (exported_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE export_history');
    }
}
