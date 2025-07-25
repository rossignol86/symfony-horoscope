<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250724091420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horoscope (id INT AUTO_INCREMENT NOT NULL, signe_id INT DEFAULT NULL, date_du_jour DATE NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_4CA15B46FFD8ADF1 (signe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE horoscope ADD CONSTRAINT FK_4CA15B46FFD8ADF1 FOREIGN KEY (signe_id) REFERENCES signe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horoscope DROP FOREIGN KEY FK_4CA15B46FFD8ADF1');
        $this->addSql('DROP TABLE horoscope');
    }
}
