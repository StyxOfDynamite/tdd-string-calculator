<?php

namespace Tests;

use App\StringCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    
    public function testItEvaluatesEmptyStringAsZero()
    {
        $calculator = new StringCalculator();

        $this->assertSame(0, $calculator->add(''));
    }

    
    public function testItfindsTheSumOfASingleNumber()
    {
        $calculator = new StringCalculator();

        $this->assertSame(5, $calculator->add('5'));
    }

    
    public function testItfindsTheSumOfTwoNumbers()
    {
        $calculator = new StringCalculator();

        $this->assertSame(10, $calculator->add('5,5'));
    }

    
    public function testItfindsTheSumOfAnyNumbers()
    {
        $calculator = new StringCalculator();

        $this->assertSame(19, $calculator->add('5,5,5,4'));
    }

    
    public function testItAcceptsANewlineAsADelimeter()
    {
        $calculator = new StringCalculator();

        $this->assertSame(10, $calculator->add("5\n5"));
    }

    
    public function testNegativeNumbersAreNotAllowed()
    {
        $calculator = new StringCalculator();

        $this->expectException(InvalidArgumentException::class);

        $calculator->add('5,-4');
    }

    
    public function testNumbersGreaterThan1000AreIgnored()
    {
        $calculator = new StringCalculator();

        $this->assertEquals(5, $calculator->add('5,1001'));
    }

    public function testItSupportsCustomDelimeters()
    {
        $calculator = new StringCalculator();

        $this->assertEquals(20, $calculator->add("//:\n5:4:11"));
    }
}
