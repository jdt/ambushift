<?php

namespace AmbuShiftBundle\Controller;

use AmbuShiftBundle\Util\IResponseBuilder;

class HomeController
{
	private $responseBuilder;

	public function __construct(IResponseBuilder $responseBuilder)
	{
		$this->responseBuilder = $responseBuilder;
	}

    public function indexAction()
    {
        return $this->responseBuilder->asView('AmbuShiftBundle:Default:index.html.twig');
    }
}
