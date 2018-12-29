<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228161528 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9C4CF44DC');
        $this->addSql('DROP INDEX UNIQ_1483A5E9C4CF44DC ON users');
        $this->addSql('ALTER TABLE users ADD profile_image_url VARCHAR(255) NOT NULL, ADD profile_image_size INT NOT NULL, DROP profile_image_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD profile_image_id INT DEFAULT NULL, DROP profile_image_url, DROP profile_image_size');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9C4CF44DC FOREIGN KEY (profile_image_id) REFERENCES profile_image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9C4CF44DC ON users (profile_image_id)');
    }
}