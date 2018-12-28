<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181228175442 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E986383B10');
        $this->addSql('DROP INDEX UNIQ_1483A5E986383B10 ON users');
        $this->addSql('ALTER TABLE users ADD avatar VARCHAR(255) DEFAULT NULL, DROP avatar_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD avatar_id INT DEFAULT NULL, DROP avatar');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar_image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E986383B10 ON users (avatar_id)');
    }
}
