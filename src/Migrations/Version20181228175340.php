<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228175340 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE avatar_image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE profile_image');
        $this->addSql('ALTER TABLE users ADD avatar_id INT DEFAULT NULL, DROP profile_image_url, DROP profile_image_size');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar_image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E986383B10 ON users (avatar_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E986383B10');
        $this->addSql('CREATE TABLE profile_image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE avatar_image');
        $this->addSql('DROP INDEX UNIQ_1483A5E986383B10 ON users');
        $this->addSql('ALTER TABLE users ADD profile_image_url VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD profile_image_size INT NOT NULL, DROP avatar_id');
    }
}
