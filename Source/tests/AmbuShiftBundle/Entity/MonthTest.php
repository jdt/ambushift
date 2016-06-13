<?php
namespace Tests\AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Month;

use\PHPUnit_Framework_TestCase;

class MonthTest extends PHPUnit_Framework_TestCase
{
    public function testIsValid()
    {
        $this->assertTrue(Month::isValid(2016, 2));
        $this->assertTrue(Month::isValid("2016", "2"));
        $this->assertTrue(Month::isValid(2016, "2"));
        $this->assertFalse(Month::isValid(2016, null));
        $this->assertFalse(Month::isValid(null, 2));
        $this->assertFalse(Month::isValid(null, null));
        $this->assertFalse(Month::isValid("aa", 2));
        $this->assertFalse(Month::isValid(2016, "aa"));
        $this->assertFalse(Month::isValid("aa", "aa"));
        $this->assertFalse(Month::isValid(2016, 0));
        $this->assertFalse(Month::isValid(2016, 13));
        $this->assertFalse(Month::isValid(-1, 13));
    }
}
