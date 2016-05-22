<?php
namespace AmbuShiftBundle\Entity;

class Shift
{
    private $id;
    private $from;
    private $to;

    public function __construct(DateTime $from, DateTime $to)
    {
    	$this->from = $from;
    	$this->to = $to;
    }
}