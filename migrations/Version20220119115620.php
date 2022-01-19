<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119115620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9293CD56D');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A9DE18E50B');
        $this->addSql('DROP INDEX UNIQ_FEC530A9DE18E50B ON content');
        $this->addSql('DROP INDEX UNIQ_FEC530A9293CD56D ON content');
        $this->addSql('ALTER TABLE content ADD basket_id INT DEFAULT NULL, ADD product_id INT DEFAULT NULL, DROP basket_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A91BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A91BE1FB52 ON content (basket_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A94584665A ON content (product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A91BE1FB52');
        $this->addSql('ALTER TABLE content DROP FOREIGN KEY FK_FEC530A94584665A');
        $this->addSql('DROP INDEX UNIQ_FEC530A91BE1FB52 ON content');
        $this->addSql('DROP INDEX UNIQ_FEC530A94584665A ON content');
        $this->addSql('ALTER TABLE content ADD basket_id_id INT DEFAULT NULL, ADD product_id_id INT DEFAULT NULL, DROP basket_id, DROP product_id');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9293CD56D FOREIGN KEY (basket_id_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE content ADD CONSTRAINT FK_FEC530A9DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9DE18E50B ON content (product_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FEC530A9293CD56D ON content (basket_id_id)');
    }
}
