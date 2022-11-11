<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190910011241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pedido (id INT AUTO_INCREMENT NOT NULL, proveedor_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, detalle LONGTEXT NOT NULL, deuda DOUBLE PRECISION NOT NULL, estado VARCHAR(50) NOT NULL, fecha DATE NOT NULL, pcompra_path VARCHAR(255) NOT NULL, vale_path VARCHAR(255) DEFAULT NULL, factura_path VARCHAR(255) DEFAULT NULL, INDEX IDX_C4EC16CECB305D73 (proveedor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proveedor (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha DATE NOT NULL, cuit VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pedido ADD CONSTRAINT FK_C4EC16CECB305D73 FOREIGN KEY (proveedor_id) REFERENCES proveedor (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pedido DROP FOREIGN KEY FK_C4EC16CECB305D73');
        $this->addSql('DROP TABLE pedido');
        $this->addSql('DROP TABLE proveedor');
    }
}
