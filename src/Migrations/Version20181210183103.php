<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210183103 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD seo_meta_data_id INT DEFAULT NULL, ADD facebook_meta_data_id INT DEFAULT NULL, ADD twitter_meta_data_id INT DEFAULT NULL, ADD slug VARCHAR(100) NOT NULL, ADD language VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689A4416FC FOREIGN KEY (seo_meta_data_id) REFERENCES seo_meta_datas (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168BB185326 FOREIGN KEY (facebook_meta_data_id) REFERENCES facebook_data (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168EE30D17B FOREIGN KEY (twitter_meta_data_id) REFERENCES twitter_data (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168989D9B62 ON articles (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD31689A4416FC ON articles (seo_meta_data_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168BB185326 ON articles (facebook_meta_data_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168EE30D17B ON articles (twitter_meta_data_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689A4416FC');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168BB185326');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168EE30D17B');
        $this->addSql('DROP INDEX UNIQ_BFDD3168989D9B62 ON articles');
        $this->addSql('DROP INDEX UNIQ_BFDD31689A4416FC ON articles');
        $this->addSql('DROP INDEX UNIQ_BFDD3168BB185326 ON articles');
        $this->addSql('DROP INDEX UNIQ_BFDD3168EE30D17B ON articles');
        $this->addSql('ALTER TABLE articles DROP seo_meta_data_id, DROP facebook_meta_data_id, DROP twitter_meta_data_id, DROP slug, DROP language');
    }
}
