<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190320232501 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proposal (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, user_id INT DEFAULT NULL, amount NUMERIC(2, 1) NOT NULL, currency VARCHAR(3) DEFAULT \'EUR\' NOT NULL, creation_date DATETIME NOT NULL, last_update DATETIME NOT NULL, INDEX IDX_BFE59472166D1F9C (project_id), INDEX IDX_BFE59472A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE59472166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE59472A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE proposal');
    }
}
