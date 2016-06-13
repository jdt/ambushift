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

    public function testGetEarlierShouldReturnMonthBefore()
    {
        $month = new Month(2016, 2);

        $earlier = $month->getEarlier();
        $this->assertEquals(2016, $earlier->getYear());
        $this->assertEquals(1, $earlier->getMonth());

        $earlier = $earlier->getEarlier();
        $this->assertEquals(2015, $earlier->getYear());
        $this->assertEquals(12, $earlier->getMonth());
    }

    public function testGetLaterShouldReturnMonthAfter()
    {
        $month = new Month(2016, 11);

        $later = $month->getLater();
        $this->assertEquals(2016, $later->getYear());
        $this->assertEquals(12, $later->getMonth());

        $later = $later->getLater();
        $this->assertEquals(2017, $later->getYear());
        $this->assertEquals(1, $later->getMonth());
    }
}
