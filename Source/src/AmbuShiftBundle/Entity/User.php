<?php
namespace AmbuShiftBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

class User extends BaseUser
{
    protected $id;

    private $name;

    private $shiftWorkers;

    public function __construct()
    {
        parent::__construct();

        $this->shiftWorkers = new ArrayCollection();
    }

    public function getName()
    {
    	return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}