<?php
namespace Tests\AmbuShiftBundle\Controller;

use AmbuShiftBundle\Controller\ShiftController;
use AmbuShiftBundle\Entity\OperatingMonth;
use AmbuShiftBundle\Entity\Month;
use AmbuShiftBundle\ViewModel\ShiftViewModel;

use \DateTime;

use\PHPUnit_Framework_TestCase;

class ShiftControllerTest extends PHPUnit_Framework_TestCase
{
	private $controller;

    public function setUp()
    {
        $this->responseBuilder = $this->getMock("AmbuShiftBundle\Util\IResponseBuilder");
        $this->operatingMonthRepository = $this->getMock("AmbuShiftBundle\Repository\IOperatingMonthRepository");
        $this->calendar = $this->getMock("AmbuShiftBundle\Service\ICalendar");

        $this->controller = new ShiftController($this->responseBuilder, $this->operatingMonthRepository, $this->calendar);
    }

    public function testIndexActionShouldRenderShiftViewForCurrentMonth()
    {
        $response = "FOO";

        $month = new OperatingMonth("2016", "05");
    	$this->calendar->expects($this->once())->method("getCurrentDate")->will($this->returnValue(new DateTime("2016-05-01")));
        $this->operatingMonthRepository->expects($this->once())->method('getOperatingMonth')->with($this->equalTo(new Month(2016, 5)))->will($this->returnValue($month));

        $expectedData = array("view" => new ShiftViewModel($month));

        $this->responseBuilder->expects($this->once())->method('asView')->with($this->equalTo('AmbuShiftBundle:Default:shift.html.twig'), $this->equalTo($expectedData))->will($this->returnValue($response));

        $result = $this->controller->indexAction();
        $this->assertEquals($response, $result);
    }

    public function testIndexActionForNonExistingMonthShouldReturnNewMonth()
    {
        $response = "FOO";

        $this->operatingMonthRepository->expects($this->once())->method('getOperatingMonth')->with($this->equalTo(new Month(2016, 1)))->will($this->returnValue(null));

        $expectedData = array("view" => new ShiftViewModel(new OperatingMonth(2016, 1)));

        $this->responseBuilder->expects($this->once())->method('asView')->with($this->equalTo('AmbuShiftBundle:Default:shift.html.twig'), $this->equalTo($expectedData))->will($this->returnValue($response));

        $result = $this->controller->indexAction(2016, 1);
        $this->assertEquals($response, $result);
    }

    public function testIndexActionForInvalidMonthShouldReturnCurrentMonth()
    {
        $response = "FOO";

        $month = new OperatingMonth("2016", "05");
        $this->calendar->expects($this->once())->method("getCurrentDate")->will($this->returnValue(new DateTime("2016-05-01")));
        $this->operatingMonthRepository->expects($this->once())->method('getOperatingMonth')->with($this->equalTo(new Month(2016, 5)))->will($this->returnValue($month));

        $expectedData = array("view" => new ShiftViewModel($month));

        $this->responseBuilder->expects($this->once())->method('asView')->with($this->equalTo('AmbuShiftBundle:Default:shift.html.twig'), $this->equalTo($expectedData))->will($this->returnValue($response));

        $result = $this->controller->indexAction("foo", "bar");
        $this->assertEquals($response, $result);
    }
}