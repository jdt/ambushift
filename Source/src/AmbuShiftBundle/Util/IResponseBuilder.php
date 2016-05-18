<?php
namespace AmbuShiftBundle\Util;

interface IResponseBuilder
{
    public function asView($viewName, $args = array());
}