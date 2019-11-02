<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191102122509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calculated_trade_parent_asset DROP FOREIGN KEY FK_398B69C0B68E36CC');
        $this->addSql('ALTER TABLE calculated_trade_side DROP FOREIGN KEY FK_E219B676C2D9760');
        $this->addSql('ALTER TABLE calculated_trade DROP FOREIGN KEY FK_C5B983436F10003');
        $this->addSql('ALTER TABLE calculated_trade_asset DROP FOREIGN KEY FK_351FB965D81C4');
        $this->addSql('DROP TABLE calculated_trade');
        $this->addSql('DROP TABLE calculated_trade_asset');
        $this->addSql('DROP TABLE calculated_trade_parent_asset');
        $this->addSql('DROP TABLE calculated_trade_side');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE calculated_trade (id INT AUTO_INCREMENT NOT NULL, winning_side_id INT DEFAULT NULL, league_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, percentage NUMERIC(10, 4) DEFAULT NULL, value_gap INT DEFAULT NULL, version SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C5B983436F10003 (winning_side_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE calculated_trade_asset (id INT AUTO_INCREMENT NOT NULL, side_id INT DEFAULT NULL, asset_id INT DEFAULT NULL, value INT DEFAULT NULL, INDEX IDX_351FB5DA1941 (asset_id), INDEX IDX_351FB965D81C4 (side_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE calculated_trade_parent_asset (calculated_trade_id INT NOT NULL, asset_id INT NOT NULL, INDEX IDX_398B69C0B68E36CC (calculated_trade_id), INDEX IDX_398B69C05DA1941 (asset_id), PRIMARY KEY(calculated_trade_id, asset_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE calculated_trade_side (id INT AUTO_INCREMENT NOT NULL, trade_id INT DEFAULT NULL, value INT DEFAULT NULL, INDEX IDX_E219B676C2D9760 (trade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE calculated_trade ADD CONSTRAINT FK_C5B983436F10003 FOREIGN KEY (winning_side_id) REFERENCES calculated_trade_side (id)');
        $this->addSql('ALTER TABLE calculated_trade_asset ADD CONSTRAINT FK_351FB5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
        $this->addSql('ALTER TABLE calculated_trade_asset ADD CONSTRAINT FK_351FB965D81C4 FOREIGN KEY (side_id) REFERENCES calculated_trade_side (id)');
        $this->addSql('ALTER TABLE calculated_trade_parent_asset ADD CONSTRAINT FK_398B69C05DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calculated_trade_parent_asset ADD CONSTRAINT FK_398B69C0B68E36CC FOREIGN KEY (calculated_trade_id) REFERENCES calculated_trade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calculated_trade_side ADD CONSTRAINT FK_E219B676C2D9760 FOREIGN KEY (trade_id) REFERENCES calculated_trade (id)');
    }
}
