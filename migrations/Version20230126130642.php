<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126130642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD image_name VARCHAR(255) NOT NULL, DROP image');
        $this->addSql('ALTER TABLE users ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F77D927C FOREIGN KEY (panier_id) REFERENCES paniers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F77D927C ON users (panier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD image VARCHAR(255) DEFAULT NULL, DROP image_name');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9F77D927C');
        $this->addSql('DROP INDEX UNIQ_1483A5E9F77D927C ON users');
        $this->addSql('ALTER TABLE users DROP panier_id');
    }
}
