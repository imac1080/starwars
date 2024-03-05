<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305182344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_charecters (movie_id INT NOT NULL, charecters_id INT NOT NULL, INDEX IDX_484873248F93B6FC (movie_id), INDEX IDX_484873249AE35F24 (charecters_id), PRIMARY KEY(movie_id, charecters_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_charecters ADD CONSTRAINT FK_484873248F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_charecters ADD CONSTRAINT FK_484873249AE35F24 FOREIGN KEY (charecters_id) REFERENCES charecters (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_charecters DROP FOREIGN KEY FK_484873248F93B6FC');
        $this->addSql('ALTER TABLE movie_charecters DROP FOREIGN KEY FK_484873249AE35F24');
        $this->addSql('DROP TABLE movie_charecters');
    }
}
