<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217090206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, users_id_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, featured_image VARCHAR(255) NOT NULL, INDEX IDX_BFDD316898333A1E (users_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_articles (categories_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_69239851A21214B7 (categories_id), INDEX IDX_692398511EBAF6CC (articles_id), PRIMARY KEY(categories_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, articles_id_id INT DEFAULT NULL, contenu VARCHAR(255) NOT NULL, actif SMALLINT NOT NULL, email VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, rgpd SMALLINT NOT NULL, INDEX IDX_D9BEC0C497A6B6A3 (articles_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_cles (id INT AUTO_INCREMENT NOT NULL, mot_cle VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_cles_articles (mot_cles_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_3728DCE6855234A9 (mot_cles_id), INDEX IDX_3728DCE61EBAF6CC (articles_id), PRIMARY KEY(mot_cles_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316898333A1E FOREIGN KEY (users_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE categories_articles ADD CONSTRAINT FK_69239851A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_articles ADD CONSTRAINT FK_692398511EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C497A6B6A3 FOREIGN KEY (articles_id_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE mot_cles_articles ADD CONSTRAINT FK_3728DCE6855234A9 FOREIGN KEY (mot_cles_id) REFERENCES mot_cles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_cles_articles ADD CONSTRAINT FK_3728DCE61EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categories_articles DROP FOREIGN KEY FK_692398511EBAF6CC');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C497A6B6A3');
        $this->addSql('ALTER TABLE mot_cles_articles DROP FOREIGN KEY FK_3728DCE61EBAF6CC');
        $this->addSql('ALTER TABLE categories_articles DROP FOREIGN KEY FK_69239851A21214B7');
        $this->addSql('ALTER TABLE mot_cles_articles DROP FOREIGN KEY FK_3728DCE6855234A9');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316898333A1E');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_articles');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE mot_cles');
        $this->addSql('DROP TABLE mot_cles_articles');
        $this->addSql('DROP TABLE user');
    }
}
