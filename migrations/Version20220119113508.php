<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119113508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, customer_id_id INT NOT NULL, UNIQUE INDEX UNIQ_2246507BB171EB6C (customer_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, content_product_quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_product (content_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C42DD1E84A0A3ED (content_id), INDEX IDX_C42DD1E4584665A (product_id), PRIMARY KEY(content_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_basket (content_id INT NOT NULL, basket_id INT NOT NULL, INDEX IDX_4A7020D784A0A3ED (content_id), INDEX IDX_4A7020D71BE1FB52 (basket_id), PRIMARY KEY(content_id, basket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, customer_admin INT NOT NULL, customer_first_name VARCHAR(250) NOT NULL, customer_last_name VARCHAR(250) NOT NULL, customer_email VARCHAR(250) NOT NULL, customer_phone VARCHAR(10) DEFAULT NULL, customer_password VARCHAR(250) NOT NULL, customer_address VARCHAR(250) NOT NULL, customer_post_code VARCHAR(5) NOT NULL, customer_city VARCHAR(250) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, basket_id_id INT NOT NULL, order_content JSON NOT NULL, order_date DATE NOT NULL, order_total NUMERIC(10, 2) NOT NULL, order_status INT NOT NULL, UNIQUE INDEX UNIQ_F5299398293CD56D (basket_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(250) NOT NULL, product_author VARCHAR(250) NOT NULL, product_date INT NOT NULL, product_desc LONGTEXT DEFAULT NULL, product_cover VARCHAR(250) DEFAULT NULL, product_price NUMERIC(3, 2) NOT NULL, product_stock INT NOT NULL, product_category VARCHAR(250) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BB171EB6C FOREIGN KEY (customer_id_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_basket ADD CONSTRAINT FK_4A7020D784A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_basket ADD CONSTRAINT FK_4A7020D71BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398293CD56D FOREIGN KEY (basket_id_id) REFERENCES basket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_basket DROP FOREIGN KEY FK_4A7020D71BE1FB52');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398293CD56D');
        $this->addSql('ALTER TABLE content_product DROP FOREIGN KEY FK_C42DD1E84A0A3ED');
        $this->addSql('ALTER TABLE content_basket DROP FOREIGN KEY FK_4A7020D784A0A3ED');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BB171EB6C');
        $this->addSql('ALTER TABLE content_product DROP FOREIGN KEY FK_C42DD1E4584665A');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_product');
        $this->addSql('DROP TABLE content_basket');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
    }
}
