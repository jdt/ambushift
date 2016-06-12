<?php
namespace AmbuShiftBundle\Controller;

use AmbuShiftBundle\Util\IResponseBuilder;
use AmbuShiftBundle\Repository\IShiftRepository;
use AmbuShiftBundle\Util\IUserProvider;

class ShiftEnrollmentController
{
	private $responseBuilder;
    private $shiftRepository;
	private $userProvider;

	public function __construct(IResponseBuilder $responseBuilder, IShiftRepository $shiftRepository, IUserProvider $userProvider)
	{
		$this->responseBuilder = $responseBuilder;
        $this->shiftRepository = $shiftRepository;
		$this->userProvider = $userProvider;
	}

    public function enrollAction($shiftId, $crewPositionId)
    {
    	$shift = $this->shiftRepository->getShiftById($shiftId);
        $shift->enroll($this->userProvider->getCurrentUser(), $crewPositionId);
        $this->shiftRepository->save($shift);

        return $this->responseBuilder->asRedirect("shift", array());
    }
}
