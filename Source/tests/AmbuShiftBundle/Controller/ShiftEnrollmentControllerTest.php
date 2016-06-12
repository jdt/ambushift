<?php
namespace Tests\AmbuShiftBundle\Controller;

use AmbuShiftBundle\Controller\ShiftEnrollmentController;
use AmbuShiftBundle\Entity\User;
use AmbuShiftBundle\ViewModel\ShiftViewModel;

use \DateTime;

use\PHPUnit_Framework_TestCase;

class ShiftEnrollmentControllerTest extends PHPUnit_Framework_TestCase
{
    private $responseBuilder;
    private $shiftRepository;
    private $userProvider;

	private $controller;

    public function setUp()
    {
        $this->responseBuilder = $this->getMock("AmbuShiftBundle\Util\IResponseBuilder");
        $this->shiftRepository = $this->getMock("AmbuShiftBundle\Repository\IShiftRepository");
        $this->userProvider = $this->getMock("AmbuShiftBundle\Util\IUserProvider");

        $this->controller = new ShiftEnrollmentController($this->responseBuilder, $this->shiftRepository, $this->userProvider);
    }

    public function testEnrollActionShouldEnrollCurrentUserIntoShiftForCrewPositionAndRedirect()
    {
        $shiftId = 42;
        $crewPositionId = 3;
        $user = new User();
        $shift = $this->getMockBuilder("AmbuShiftBundle\Entity\Shift")->disableOriginalConstructor()->getMock();

        $this->shiftRepository->expects($this->once())->method('getShiftById')->with($this->equalTo($shiftId))->will($this->returnValue($shift));
        $this->userProvider->expects($this->once())->method("getCurrentUser")->will($this->returnValue($user));

        $shift->expects($this->once())->method("enroll")->with($this->equalTo($user), $this->equalTo($crewPositionId));
        $this->shiftRepository->expects($this->once())->method('save')->with($this->equalTo($shift));

        $this->responseBuilder->expects($this->once())->method("asRedirect")->with($this->equalTo("shift"), $this->equalTo(array()))->will($this->returnValue("FOO"));

        $result = $this->controller->enrollAction($shiftId, $crewPositionId);
        $this->assertEquals("FOO", $result);
    }
}
