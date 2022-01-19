<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119133746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BB171EB6C');
        $this->addSql('DROP INDEX UNIQ_2246507BB171EB6C ON basket');
        $this->addSql('ALTER TABLE basket CHANGE customer_id_id customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2246507B9395C3F3 ON basket (customer_id)');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398293CD56D');
        $this->addSql('DROP INDEX UNIQ_F5299398293CD56D ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE basket_id_id basket_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F52993981BE1FB52 ON `order` (basket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B9395C3F3');
        $this->addSql('DROP INDEX UNIQ_2246507B9395C3F3 ON basket');
        $this->addSql('ALTER TABLE basket CHANGE customer_id customer_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BB171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2246507BB171EB6C ON basket (customer_id_id)');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981BE1FB52');
        $this->addSql('DROP INDEX UNIQ_F52993981BE1FB52 ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE basket_id basket_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398293CD56D FOREIGN KEY (basket_id_id) REFERENCES basket (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398293CD56D ON `order` (basket_id_id)');
    }
}
