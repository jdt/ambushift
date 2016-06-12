<?php
namespace AmbuShiftBundle\Util;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ResponseBuilder implements IResponseBuilder
{
    private $templating;
    private $routerInterface;

    public function __construct(EngineInterface $templating, RouterInterface $routerInterface)
    {
        $this->templating = $templating;
        $this->routerInterface = $routerInterface;
    }

    public function asView($viewName, $args = array())
    {
        return $this->templating->renderResponse($viewName, $args);
    }

    public function asRedirect($route, $args = array())
    {
        return new RedirectResponse($this->routerInterface->generate($route, $args));
    }
}