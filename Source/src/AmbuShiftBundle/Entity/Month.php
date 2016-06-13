<?php
namespace AmbuShiftBundle\Entity;

use \DateTime;

class Month
{
	private $year;
	private $month;

	public function __construct($year, $month)
	{
		$this->year = $year;
		$this->month = $month;
	}

	public function getMonth()
	{
		return $this->month;
	}

	public function getYear()
	{
		return $this->year;
	}

	public function getEarlier()
	{
		$thisDate = DateTime::createFromFormat("Y-m-d", $this->year."-".$this->month."-1");
		$thisDate->modify('first day of previous month');

		return new Month($thisDate->format("Y"), $thisDate->format("n"));
	}

	public function getLater()
	{
		$thisDate = DateTime::createFromFormat("Y-m-d", $this->year."-".$this->month."-1");
		$thisDate->modify('first day of next month');

		return new Month($thisDate->format("Y"), $thisDate->format("n"));
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