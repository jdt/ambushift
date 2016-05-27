<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160527202426 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ambushift_crew_position (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, vehicleId INT DEFAULT NULL, INDEX IDX_53C75703E00341DE (vehicleId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ambushift_service (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ambushift_shift (id INT AUTO_INCREMENT NOT NULL, `from` DATETIME NOT NULL, `to` DATETIME NOT NULL, vehicleId INT DEFAULT NULL, serviceId INT DEFAULT NULL, INDEX IDX_159798E00341DE (vehicleId), INDEX IDX_15979889697FA8 (serviceId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ambushift_shift_worker (id INT AUTO_INCREMENT NOT NULL, userId INT DEFAULT NULL, crewPositionId INT DEFAULT NULL, INDEX IDX_12C55EB364B64DCC (userId), INDEX IDX_12C55EB3D4811B73 (crewPositionId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ambushift_time_slot (id INT AUTO_INCREMENT NOT NULL, `from` VARCHAR(8) NOT NULL, `to` VARCHAR(8) NOT NULL, serviceId INT DEFAULT NULL, INDEX IDX_771284B289697FA8 (serviceId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ambushift_vehicle (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, serviceId INT DEFAULT NULL, INDEX IDX_F076150989697FA8 (serviceId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ambushift_crew_position ADD CONSTRAINT FK_53C75703E00341DE FOREIGN KEY (vehicleId) REFERENCES ambushift_vehicle (id)');
        $this->addSql('ALTER TABLE ambushift_shift ADD CONSTRAINT FK_159798E00341DE FOREIGN KEY (vehicleId) REFERENCES ambushift_vehicle (id)');
        $this->addSql('ALTER TABLE ambushift_shift ADD CONSTRAINT FK_15979889697FA8 FOREIGN KEY (serviceId) REFERENCES ambushift_service (id)');
        $this->addSql('ALTER TABLE ambushift_shift_worker ADD CONSTRAINT FK_12C55EB364B64DCC FOREIGN KEY (userId) REFERENCES ambushift_user (id)');
        $this->addSql('ALTER TABLE ambushift_shift_worker ADD CONSTRAINT FK_12C55EB3D4811B73 FOREIGN KEY (crewPositionId) REFERENCES ambushift_crew_position (id)');
        $this->addSql('ALTER TABLE ambushift_time_slot ADD CONSTRAINT FK_771284B289697FA8 FOREIGN KEY (serviceId) REFERENCES ambushift_service (id)');
        $this->addSql('ALTER TABLE ambushift_vehicle ADD CONSTRAINT FK_F076150989697FA8 FOREIGN KEY (serviceId) REFERENCES ambushift_service (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ambushift_shift_worker DROP FOREIGN KEY FK_12C55EB3D4811B73');
        $this->addSql('ALTER TABLE ambushift_shift DROP FOREIGN KEY FK_15979889697FA8');
        $this->addSql('ALTER TABLE ambushift_time_slot DROP FOREIGN KEY FK_771284B289697FA8');
        $this->addSql('ALTER TABLE ambushift_vehicle DROP FOREIGN KEY FK_F076150989697FA8');
        $this->addSql('ALTER TABLE ambushift_crew_position DROP FOREIGN KEY FK_53C75703E00341DE');
        $this->addSql('ALTER TABLE ambushift_shift DROP FOREIGN KEY FK_159798E00341DE');
        $this->addSql('DROP TABLE ambushift_crew_position');
        $this->addSql('DROP TABLE ambushift_service');
        $this->addSql('DROP TABLE ambushift_shift');
        $this->addSql('DROP TABLE ambushift_shift_worker');
        $this->addSql('DROP TABLE ambushift_time_slot');
        $this->addSql('DROP TABLE ambushift_vehicle');
    }
}
