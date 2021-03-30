<?php

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private $calculator;

    public function setUp(): void
    {
        $this->calculator = new \App\StringCalculator;
    }

    public function testIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testItReturnsZeroForEmptyString()
    {
        $result = $this->calculator->add("");
        $this->assertEquals(0, $result);
    }

    public function testItReturnsGivenValueIfSingleNumber()
    {
        $result = $this->calculator->add("4");
        $this->assertEquals(4, $result);
    }

    public function testItAddsTwoNumbersTogether()
    {
        $result = $this->calculator->add("4,5");
        $this->assertEquals(9, $result);
    }

    public function testItAddsMultipleNumbersTogether()
    {
        $result = $this->calculator->add("4,5,6");
        $this->assertEquals(15, $result);
    }

    public function testItHandlesNewLines()
    {
        $result = $this->calculator->add("4\n5\n6");
        $this->assertEquals(15, $result);
    }

    public function testItHandlesNewLinesOrCommas()
    {
        $result = $this->calculator->add("4\n5,6,1");
        $this->assertEquals(16, $result);
    }
    
    public function testItUsesSuppliedSeperator()
    {
        $input = "//-\n4-5-6";
        $result = $this->calculator->add($input);
        $this->assertEquals(15, $result);
    }

    public function testItThrowsNegativesNotAllowedException()
    {
        $this->expectException(InvalidArgumentException::class);
        $input = "4,-5";
        $result = $this->calculator->add($input);
    }
}
