<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191121201032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE4873418');
        $this->addSql('DROP INDEX UNIQ_D34A04ADE4873418 ON product');
        $this->addSql('ALTER TABLE product ADD main_image VARCHAR(255) DEFAULT NULL, DROP main_image_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product ADD main_image_id INT DEFAULT NULL, DROP main_image');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE4873418 FOREIGN KEY (main_image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04ADE4873418 ON product (main_image_id)');
    }
}
