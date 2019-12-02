<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191128123124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer ADD first_name VARCHAR(50) NOT NULL, ADD last_name VARCHAR(50) NOT NULL, ADD company_name VARCHAR(100) DEFAULT NULL, ADD phone VARCHAR(10) NOT NULL, ADD email VARCHAR(100) NOT NULL, ADD country VARCHAR(50) NOT NULL, ADD first_address VARCHAR(255) NOT NULL, ADD second_address VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(100) NOT NULL, ADD postcode VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD customer_id INT NOT NULL, ADD date DATETIME NOT NULL, ADD message VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_F52993989395C3F3 ON `order` (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE customer DROP first_name, DROP last_name, DROP company_name, DROP phone, DROP email, DROP country, DROP first_address, DROP second_address, DROP city, DROP postcode');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('DROP INDEX IDX_F52993989395C3F3 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP customer_id, DROP date, DROP message');
    }
}
