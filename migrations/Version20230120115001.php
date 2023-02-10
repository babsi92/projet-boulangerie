<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120115001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD paniers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CBE35FDA0 FOREIGN KEY (paniers_id) REFERENCES paniers (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CBE35FDA0 ON produits (paniers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CBE35FDA0');
        $this->addSql('DROP INDEX IDX_BE2DDF8CBE35FDA0 ON produits');
        $this->addSql('ALTER TABLE produits DROP paniers_id');
    }
}
