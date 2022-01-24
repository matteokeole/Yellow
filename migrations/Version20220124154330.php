<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124154330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM content');
        $this->addSql('ALTER TABLE content DROP INDEX UNIQ_FEC530A91BE1FB52, ADD INDEX IDX_FEC530A91BE1FB52 (basket_id)');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A94584665A');
        $this->addSql('DROP INDEX UNIQ_FEC530A94584665A ON content');
        $this->addSql('ALTER TABLE content DROP product_id, CHANGE basket_id basket_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` CHANGE order_content order_content VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP INDEX IDX_FEC530A91BE1FB52, ADD UNIQUE INDEX UNIQ_FEC530A91BE1FB52 (basket_id)');
        $this->addSql('ALTER TABLE content ADD product_id INT DEFAULT NULL, CHANGE basket_id basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A94584665A ON content (product_id)');
        $this->addSql('ALTER TABLE `order` CHANGE order_content order_content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
