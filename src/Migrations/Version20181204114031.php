<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204114031 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, is_enabled TINYINT(1) NOT NULL, is_confirmed TINYINT(1) NOT NULL, is_deleted TINYINT(1) NOT NULL, agreed_terms_at DATETIME NOT NULL, confirmation_token VARCHAR(80) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, menu_type VARCHAR(20) NOT NULL, name VARCHAR(120) NOT NULL, description LONGTEXT DEFAULT NULL, is_published TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_items (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, parent_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, link_type VARCHAR(255) NOT NULL, is_published TINYINT(1) NOT NULL, display_children TINYINT(1) NOT NULL, sort_order INT NOT NULL, is_home TINYINT(1) NOT NULL, INDEX IDX_70B2CA2ACCD7E912 (menu_id), INDEX IDX_70B2CA2A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, content LONGTEXT NOT NULL, is_published TINYINT(1) NOT NULL, published_start_at DATETIME DEFAULT NULL, published_end_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_23A0E66989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_items ADD CONSTRAINT FK_70B2CA2ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menus (id)');
        $this->addSql('ALTER TABLE menu_items ADD CONSTRAINT FK_70B2CA2A727ACA70 FOREIGN KEY (parent_id) REFERENCES menu_items (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE menu_items DROP FOREIGN KEY FK_70B2CA2ACCD7E912');
        $this->addSql('ALTER TABLE menu_items DROP FOREIGN KEY FK_70B2CA2A727ACA70');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE menu_items');
        $this->addSql('DROP TABLE article');
    }
}
