<?php
namespace AmbuShiftBundle\Util;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ResponseBuilder implements IResponseBuilder
{
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function asView($viewName, $args = array())
    {
        return $this->templating->renderResponse($viewName, $args);
    }
}