<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Version20993112000000 extends AbstractMigration implements ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
    	if($this->container->getParameter("kernel.environment") != "dev")
    		return;

        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO ambushift_user(id, username, username_canonical, email, email_canonical, enabled, salt, password, roles, name) VALUES (1, "amb", "amb", "amb@local.host", "amb@local.host", 1, "e8kkc0eca8g8c8g8cgocg4swos8scwc", "$2y$13$j.GxOeRdxFtJ.woyoNd49eX1/oGZPrNTldXWkH.0mcH2RqXnlD7/2", "a:0:{}", "Ambulance Admin");');
        $this->addSql('INSERT INTO ambushift_user(id, username, username_canonical, email, email_canonical, enabled, salt, password, roles, name) VALUES (2, "driver", "driver", "driver@local.host", "driver@local.host", 1, "", "", "a:0:{}", "Ambulance Driver");');

        $this->addSql('INSERT INTO ambushift_service(id, description) VALUES (1, "AmbulanceService");');

        $this->addSql('INSERT INTO ambushift_vehicle(id, description, serviceId) VALUES (1, "Ambulance 1", 1);');

        $this->addSql('INSERT INTO ambushift_crew_position(id, description, vehicleId) VALUES (1, "Driver", 1);');
        $this->addSql('INSERT INTO ambushift_crew_position(id, description, vehicleId) VALUES (2, "Attendant", 1);');
        $this->addSql('INSERT INTO ambushift_crew_position(id, description, vehicleId) VALUES (3, "Trainee", 1);');
        $this->addSql('INSERT INTO ambushift_crew_position(id, description, vehicleId) VALUES (4, "Backup", 1);');

        $this->addSql('INSERT INTO ambushift_operating_month(id, year, month, serviceId) VALUES (1, 2016, 5, 1);');

        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (1, "2016-05-01 18:00:00", "2016-05-02 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (2, "2016-05-02 18:00:00", "2016-05-03 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (3, "2016-05-03 18:00:00", "2016-05-04 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (4, "2016-05-04 18:00:00", "2016-05-05 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (5, "2016-05-05 18:00:00", "2016-05-06 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (6, "2016-05-06 18:00:00", "2016-05-07 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (7, "2016-05-07 18:00:00", "2016-05-08 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (8, "2016-05-08 18:00:00", "2016-05-09 06:00:00", 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift(id, `from`, `to`, vehicleId, operatingMonthId) VALUES (9, "2016-05-09 18:00:00", "2016-05-10 06:00:00", 1, 1);');
        
        $this->addSql('INSERT INTO ambushift_shift_worker(id, userId, crewPositionId, shiftId) VALUES (1, 2, 1, 1);');
        $this->addSql('INSERT INTO ambushift_shift_worker(id, userId, crewPositionId, shiftId) VALUES (2, 2, 2, 5);');
        $this->addSql('INSERT INTO ambushift_shift_worker(id, userId, crewPositionId, shiftId) VALUES (3, 2, 3, 8);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
