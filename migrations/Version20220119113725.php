<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119113725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content_basket DROP FOREIGN KEY FK_4A7020D784A0A3ED');
        $this->addSql('ALTER TABLE content_product DROP FOREIGN KEY FK_C42DD1E84A0A3ED');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_basket');
        $this->addSql('DROP TABLE content_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, content_product_quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_basket (content_id INT NOT NULL, basket_id INT NOT NULL, INDEX IDX_4A7020D784A0A3ED (content_id), INDEX IDX_4A7020D71BE1FB52 (basket_id), PRIMARY KEY(content_id, basket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_product (content_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C42DD1E84A0A3ED (content_id), INDEX IDX_C42DD1E4584665A (product_id), PRIMARY KEY(content_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE content_basket ADD CONSTRAINT FK_4A7020D71BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_basket ADD CONSTRAINT FK_4A7020D784A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
    }
}
