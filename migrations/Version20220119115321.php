<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119115321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE content_basket');
        $this->addSql('DROP TABLE content_product');
        $this->addSql('ALTER TABLE content ADD basket_id_id INT DEFAULT NULL, ADD product_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9293CD56D FOREIGN KEY (basket_id_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9293CD56D ON content (basket_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9DE18E50B ON content (product_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE content_basket (content_id INT NOT NULL, basket_id INT NOT NULL, INDEX IDX_4A7020D784A0A3ED (content_id), INDEX IDX_4A7020D71BE1FB52 (basket_id), PRIMARY KEY(content_id, basket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content_product (content_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_C42DD1E84A0A3ED (content_id), INDEX IDX_C42DD1E4584665A (product_id), PRIMARY KEY(content_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE content_basket ADD CONSTRAINT FK_4A7020D71BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_basket ADD CONSTRAINT FK_4A7020D784A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content_product ADD CONSTRAINT FK_C42DD1E84A0A3ED FOREIGN KEY (content_id) REFERENCES content (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9293CD56D');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9DE18E50B');
        $this->addSql('DROP INDEX UNIQ_FEC530A9293CD56D ON content');
        $this->addSql('DROP INDEX UNIQ_FEC530A9DE18E50B ON content');
        $this->addSql('ALTER TABLE content DROP basket_id_id, DROP product_id_id');
    }
}
