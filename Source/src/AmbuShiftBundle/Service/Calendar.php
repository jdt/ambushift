<?php
namespace AmbuShiftBundle\Service;

use \DateTime;

class Calendar implements ICalendar
{
    private $seed;

    public function __construct($seed)
    {
        $this->seed = $seed;
    }

    public function getCurrentDate()
    {
        return new DateTime($this->seed);
    }
}
