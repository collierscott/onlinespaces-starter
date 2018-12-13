<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210180848 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, category_id INT NOT NULL, intro_content LONGTEXT NOT NULL, content LONGTEXT NOT NULL, is_published TINYINT(1) NOT NULL, published_start_at DATETIME DEFAULT NULL, published_end_at DATETIME DEFAULT NULL, cover_image VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_BFDD3168F675F31B (author_id), INDEX IDX_BFDD316812469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3AF34668727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site_settings (id INT AUTO_INCREMENT NOT NULL, site_name VARCHAR(255) NOT NULL, is_site_offline TINYINT(1) NOT NULL, access_level INT NOT NULL, list_limit INT NOT NULL, content_type VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, keywords LONGTEXT DEFAULT NULL, robots VARCHAR(255) NOT NULL, content_rights VARCHAR(255) DEFAULT NULL, temp_folder VARCHAR(255) NOT NULL, server_time_zone VARCHAR(20) NOT NULL, language VARCHAR(10) NOT NULL, facebook_app_id VARCHAR(20) DEFAULT NULL, facebook_type VARCHAR(20) NOT NULL, facebook_ttl INT NOT NULL, facebook_admins VARCHAR(255) DEFAULT NULL, facebook_profile_id VARCHAR(100) DEFAULT NULL, facebook_page VARCHAR(255) DEFAULT NULL, twitter_username VARCHAR(255) DEFAULT NULL, google_id VARCHAR(20) DEFAULT NULL, layout VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facebook_data (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(155) DEFAULT NULL, local VARCHAR(10) NOT NULL, image VARCHAR(255) DEFAULT NULL, image_secure_url VARCHAR(255) DEFAULT NULL, image_type VARCHAR(100) DEFAULT NULL, image_width INT DEFAULT NULL, image_height INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, menu_type VARCHAR(20) NOT NULL, name VARCHAR(120) NOT NULL, description LONGTEXT DEFAULT NULL, is_published TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_items (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, parent_id INT DEFAULT NULL, label VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, link_type VARCHAR(255) NOT NULL, is_published TINYINT(1) NOT NULL, display_children TINYINT(1) NOT NULL, sort_order INT NOT NULL, is_home TINYINT(1) NOT NULL, INDEX IDX_70B2CA2ACCD7E912 (menu_id), INDEX IDX_70B2CA2A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seo_meta_datas (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, meta_description VARCHAR(255) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, robots VARCHAR(255) DEFAULT NULL, extra_properties JSON NOT NULL COMMENT \'(DC2Type:json_array)\', extra_names JSON NOT NULL COMMENT \'(DC2Type:json_array)\', extra_http JSON NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE twitter_data (id INT AUTO_INCREMENT NOT NULL, card VARCHAR(100) NOT NULL, title VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, is_enabled TINYINT(1) NOT NULL, is_confirmed TINYINT(1) NOT NULL, is_deleted TINYINT(1) NOT NULL, agreed_terms_at DATETIME NOT NULL, confirmation_token VARCHAR(80) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168F675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316812469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE menu_items ADD CONSTRAINT FK_70B2CA2ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menus (id)');
        $this->addSql('ALTER TABLE menu_items ADD CONSTRAINT FK_70B2CA2A727ACA70 FOREIGN KEY (parent_id) REFERENCES menu_items (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316812469DE2');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668727ACA70');
        $this->addSql('ALTER TABLE menu_items DROP FOREIGN KEY FK_70B2CA2ACCD7E912');
        $this->addSql('ALTER TABLE menu_items DROP FOREIGN KEY FK_70B2CA2A727ACA70');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168F675F31B');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE site_settings');
        $this->addSql('DROP TABLE facebook_data');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE menu_items');
        $this->addSql('DROP TABLE seo_meta_datas');
        $this->addSql('DROP TABLE twitter_data');
        $this->addSql('DROP TABLE users');
    }
}
