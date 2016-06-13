<?php

namespace AmbuShiftBundle\Controller;

use AmbuShiftBundle\Util\IResponseBuilder;
use AmbuShiftBundle\Repository\IOperatingMonthRepository;
use AmbuShiftBundle\Service\ICalendar;
use AmbuShiftBundle\ViewModel\ShiftViewModel;
use AmbuShiftBundle\Entity\Month;
use AmbuShiftBundle\Entity\OperatingMonth;

class ShiftController
{
	private $responseBuilder;
	private $operatingMonthRepository;
	private $calendar;

	public function __construct(IResponseBuilder $responseBuilder, IOperatingMonthRepository $operatingMonthRepository, ICalendar $calendar)
	{
		$this->responseBuilder = $responseBuilder;
		$this->operatingMonthRepository = $operatingMonthRepository;
		$this->calendar = $calendar;
	}

    public function indexAction($year = null, $month = null)
    {
        if(Month::isValid($year, $month))
        {
            $selectedMonth = new Month($year, $month);
        }
        else
        {
            $now = $this->calendar->getCurrentDate();
            $selectedMonth = new Month($now->format("Y"), $now->format("n"));
        }

    	$operatingMonth = $this->operatingMonthRepository->getOperatingMonth($selectedMonth);
        if($operatingMonth ==  null)
            $operatingMonth = new OperatingMonth($selectedMonth->getYear(), $selectedMonth->getMonth());

        return $this->responseBuilder->asView(
            'AmbuShiftBundle:Default:shift.html.twig',
            array("view" => new ShiftViewModel($operatingMonth))
        );
    }
}
