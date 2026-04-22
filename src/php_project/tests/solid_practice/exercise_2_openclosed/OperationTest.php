<?php

namespace Calc\Tests\SolidPractice;

use Calc\SolidPractice\Calculator;
use PHPUnit\Framework\TestCase;

/**
 * Exercise 2: Open/Closed Principle
 *
 * Calculator hardcodes every operation in its source code.
 * Adding square root or modulo requires editing Calculator.php.
 * New feature = edit source = risk of breaking existing math.
 *
 * @group openclosed
 */
#[CoversClass(Calculator::class)]
class OperationTest extends TestCase
{
    private Calculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator(['add', 'subtract', 'multiply']);
    }

    public function test_can_execute_addition_operations(): void
    {
        $result = $this->calculator->execute('add', 2.0, 3.0);
        self::assertEquals(5.0, $result);
    }

    public function test_can_execute_subtract_operations(): void
    {
        $result = $this->calculator->execute('subtract', 10.0, 4.0);
        self::assertEquals(6.0, $result);
    }

    public function test_can_execute_multiply_operations(): void
    {
        $result = $this->calculator->execute('multiply', 3.0, 7.0);
        self::assertEquals(21.0, $result);
    }

    /**
     * Target: Adding PowerOperation should require NO changes to Calculator.php.
     * Just pass it as a new operation name.
     */
    public function test_can_execute_power_operations(): void
    {
        $calculator = new Calculator(['add', 'subtract', 'multiply', 'power']);
        $result = $calculator->execute('power', 2.0, 10.0);
        self::assertEquals(1024.0, $result);
    }

    public function test_can_execute_modulo_operations(): void
    {
        $calculator = new Calculator(['add', 'subtract', 'multiply', 'modulo']);
        $result = $calculator->execute('modulo', 17.0, 5.0);
        self::assertEquals(2.0, $result);
    }

    /**
     * After refactoring, existing operations must still work.
     * Adding new ones must not require editing the Calculator class.
     */
    public function test_existing_operations_still_work_after_adding_power(): void
    {
        $calculator = new Calculator(['add', 'subtract', 'multiply', 'power']);
        self::assertEquals(5.0, $calculator->execute('add', 2.0, 3.0));
        self::assertEquals(6.0, $calculator->execute('subtract', 10.0, 4.0));
        self::assertEquals(21.0, $calculator->execute('multiply', 3.0, 7.0));
    }

    public function test_unknown_operation_throws_exception(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->calculator->execute('divide', 10.0, 2.0);
    }
}
