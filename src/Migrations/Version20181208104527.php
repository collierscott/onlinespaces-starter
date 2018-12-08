<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181208104527 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE site_settings (id INT AUTO_INCREMENT NOT NULL, site_name VARCHAR(255) NOT NULL, is_site_offline TINYINT(1) NOT NULL, access_level INT NOT NULL, list_limit INT NOT NULL, content_type VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, keywords LONGTEXT DEFAULT NULL, robots VARCHAR(255) NOT NULL, content_rights VARCHAR(255) DEFAULT NULL, temp_folder VARCHAR(255) NOT NULL, server_time_zone VARCHAR(20) NOT NULL, language VARCHAR(10) NOT NULL, facebook_app_id VARCHAR(20) DEFAULT NULL, facebook_type VARCHAR(20) NOT NULL, facebook_ttl INT NOT NULL, facebook_admins VARCHAR(255) DEFAULT NULL, facebook_profile_id VARCHAR(100) DEFAULT NULL, facebook_page VARCHAR(255) DEFAULT NULL, twitter_username VARCHAR(255) DEFAULT NULL, google_id VARCHAR(20) DEFAULT NULL, layout VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE site_settings');
    }
}
