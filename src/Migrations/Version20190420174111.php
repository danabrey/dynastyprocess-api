<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190420174111 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE asset (id INT AUTO_INCREMENT NOT NULL, ecr_qb1 NUMERIC(10, 1) DEFAULT NULL, ecr_qb2 NUMERIC(10, 1) DEFAULT NULL, value_qb1 INT DEFAULT NULL, value_qb2 INT DEFAULT NULL, merge_name VARCHAR(255) NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, position VARCHAR(5) DEFAULT NULL, gsis_id VARCHAR(255) DEFAULT NULL, team VARCHAR(255) DEFAULT NULL, ecr_sd NUMERIC(10, 2) DEFAULT NULL, ecr_positional NUMERIC(10, 2) DEFAULT NULL, ecr_positional_sd NUMERIC(10, 2) DEFAULT NULL, ecr_redraft_positional NUMERIC(10, 2) DEFAULT NULL, ecr_redraft_positional_sd NUMERIC(10, 2) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, age NUMERIC(10, 1) DEFAULT NULL, salary_average NUMERIC(10, 2) DEFAULT NULL, free_agency_year INT DEFAULT NULL, draft_year INT DEFAULT NULL, draft_round INT DEFAULT NULL, draft_pick INT DEFAULT NULL, draft_rookie_adp INT DEFAULT NULL, draft_rookie_adp2qb INT DEFAULT NULL, college VARCHAR(255) DEFAULT NULL, height INT DEFAULT NULL, weight INT DEFAULT NULL, arm_length NUMERIC(10, 3) DEFAULT NULL, hand_size NUMERIC(10, 3) DEFAULT NULL, forty_yard_dash NUMERIC(10, 2) DEFAULT NULL, twenty_split NUMERIC(10, 2) DEFAULT NULL, ten_split NUMERIC(10, 2) DEFAULT NULL, bench_press INT DEFAULT NULL, vertical NUMERIC(10, 2) DEFAULT NULL, broad_jump NUMERIC(10, 2) DEFAULT NULL, shuttle NUMERIC(10, 2) DEFAULT NULL, three_cone_drill NUMERIC(10, 2) DEFAULT NULL, relative_athletic_score NUMERIC(10, 2) DEFAULT NULL, third_party_id_pfr VARCHAR(255) DEFAULT NULL, third_party_id_mfl VARCHAR(255) DEFAULT NULL, third_party_id_sleeper VARCHAR(255) DEFAULT NULL, third_party_id_fantasy_data VARCHAR(255) DEFAULT NULL, third_party_id_rotowire VARCHAR(255) DEFAULT NULL, third_party_id_sportradar VARCHAR(255) DEFAULT NULL, third_party_id_yahoo VARCHAR(255) DEFAULT NULL, third_party_id_espn VARCHAR(255) DEFAULT NULL, third_party_id_stats VARCHAR(255) DEFAULT NULL, third_party_id_rotoworld VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, number INT DEFAULT NULL, round INT DEFAULT NULL, tier INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imported_csv (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calculated_trade (id INT AUTO_INCREMENT NOT NULL, winning_side_id INT DEFAULT NULL, league_type VARCHAR(255) NOT NULL, percentage NUMERIC(10, 4) DEFAULT NULL, value_gap INT DEFAULT NULL, version SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_C5B983436F10003 (winning_side_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calculated_trade_parent_asset (calculated_trade_id INT NOT NULL, asset_id INT NOT NULL, INDEX IDX_398B69C0B68E36CC (calculated_trade_id), INDEX IDX_398B69C05DA1941 (asset_id), PRIMARY KEY(calculated_trade_id, asset_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calculated_trade_side (id INT AUTO_INCREMENT NOT NULL, trade_id INT DEFAULT NULL, value INT DEFAULT NULL, INDEX IDX_E219B676C2D9760 (trade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calculated_trade_asset (id INT AUTO_INCREMENT NOT NULL, side_id INT DEFAULT NULL, asset_id INT DEFAULT NULL, value INT DEFAULT NULL, INDEX IDX_351FB965D81C4 (side_id), INDEX IDX_351FB5DA1941 (asset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE calculated_trade ADD CONSTRAINT FK_C5B983436F10003 FOREIGN KEY (winning_side_id) REFERENCES calculated_trade_side (id)');
        $this->addSql('ALTER TABLE calculated_trade_parent_asset ADD CONSTRAINT FK_398B69C0B68E36CC FOREIGN KEY (calculated_trade_id) REFERENCES calculated_trade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calculated_trade_parent_asset ADD CONSTRAINT FK_398B69C05DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calculated_trade_side ADD CONSTRAINT FK_E219B676C2D9760 FOREIGN KEY (trade_id) REFERENCES calculated_trade (id)');
        $this->addSql('ALTER TABLE calculated_trade_asset ADD CONSTRAINT FK_351FB965D81C4 FOREIGN KEY (side_id) REFERENCES calculated_trade_side (id)');
        $this->addSql('ALTER TABLE calculated_trade_asset ADD CONSTRAINT FK_351FB5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calculated_trade_parent_asset DROP FOREIGN KEY FK_398B69C05DA1941');
        $this->addSql('ALTER TABLE calculated_trade_asset DROP FOREIGN KEY FK_351FB5DA1941');
        $this->addSql('ALTER TABLE calculated_trade_parent_asset DROP FOREIGN KEY FK_398B69C0B68E36CC');
        $this->addSql('ALTER TABLE calculated_trade_side DROP FOREIGN KEY FK_E219B676C2D9760');
        $this->addSql('ALTER TABLE calculated_trade DROP FOREIGN KEY FK_C5B983436F10003');
        $this->addSql('ALTER TABLE calculated_trade_asset DROP FOREIGN KEY FK_351FB965D81C4');
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE imported_csv');
        $this->addSql('DROP TABLE calculated_trade');
        $this->addSql('DROP TABLE calculated_trade_parent_asset');
        $this->addSql('DROP TABLE calculated_trade_side');
        $this->addSql('DROP TABLE calculated_trade_asset');
    }
}
