<?php

namespace Calc\Tests;

use Calc\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAddition(): void
    {
        $this->assertEquals(5.0, $this->calculator->add(2.0, 3.0));
        $this->assertEquals(0.0, $this->calculator->add(-1.0, 1.0));
        $this->assertEquals(-5.0, $this->calculator->add(-2.0, -3.0));
    }

    public function testSubtraction(): void
    {
        $this->assertEquals(1.0, $this->calculator->subtract(3.0, 2.0));
        $this->assertEquals(-2.0, $this->calculator->subtract(1.0, 3.0));
        $this->assertEquals(0.0, $this->calculator->subtract(0.0, 0.0));
    }

    public function testMultiplication(): void
    {
        $this->assertEquals(6.0, $this->calculator->multiply(2.0, 3.0));
        $this->assertEquals(-6.0, $this->calculator->multiply(-2.0, 3.0));
        $this->assertEquals(0.0, $this->calculator->multiply(0.0, 100.0));
    }

    public function testDivision(): void
    {
        $this->assertEquals(2.0, $this->calculator->divide(6.0, 3.0));
        $this->assertEquals(-2.0, $this->calculator->divide(6.0, -3.0));
        $this->assertEquals(0.0, $this->calculator->divide(0.0, 5.0));
    }

    public function testDivisionByZeroThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Division by zero is not allowed.');
        $this->calculator->divide(1.0, 0.0);
    }
}
