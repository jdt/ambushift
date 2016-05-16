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

        $this->addSql('INSERT INTO ambushift_user(id, username_canonical, email, email_canonical, enabled, salt, password, roles) VALUES (1, "amb", "amb@local.host", "amb@local.host", 1, "e8kkc0eca8g8c8g8cgocg4swos8scwc", "$2y$13$j.GxOeRdxFtJ.woyoNd49eX1/oGZPrNTldXWkH.0mcH2RqXnlD7/2", "a:0:{}")');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
