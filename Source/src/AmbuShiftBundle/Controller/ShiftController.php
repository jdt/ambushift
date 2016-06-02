<?php

namespace AmbuShiftBundle\Controller;

use AmbuShiftBundle\Util\IResponseBuilder;
use AmbuShiftBundle\Repository\IOperatingMonthRepository;
use AmbuShiftBundle\Service\ICalendar;
use AmbuShiftBundle\ViewModel\ShiftViewModel;

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

    public function indexAction()
    {
    	$now = $this->calendar->getCurrentDate();

    	$month = $this->operatingMonthRepository->getOperatingMonth($now->format("Y"), $now->format("n"));
        
        return $this->responseBuilder->asView(
            'AmbuShiftBundle:Default:shift.html.twig',
            array("view" => new ShiftViewModel($month))
        );
    }
}
