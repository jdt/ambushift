<?php
namespace AmbuShiftBundle\Entity;

class Month
{
	private $year;
	private $month;

	public function __construct($year, $month)
	{
		$this->year = $year;
		$this->month = $month;
	}

	public static function isValid($year, $month)
	{
		return Month::isValidPositiveInteger($year) && Month::isValidPositiveInteger($month) && $month > 0 && $month < 13;
	}

    private static function isValidPositiveInteger($num)
    {
        //numerical, non-decimal (value remains when rounding), greater than zero
        return is_numeric($num) && round($num, 0) == $num && $num >= 0;
    }
}