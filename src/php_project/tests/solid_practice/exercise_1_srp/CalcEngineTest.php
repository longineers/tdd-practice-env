<?php

namespace Calc\Tests\SolidPractice;

use Calc\SolidPractice\CalcEngine;
use PHPUnit\Framework\TestCase;

/**
 * Exercise 1: Single Responsibility Principle
 *
 * CalcEngine does four things: parse input, compute math, format output, log results.
 * Each is a separate reason to change. Refactor via tests into focused classes.
 *
 * @group srp
 */
#[CoversClass(CalcEngine::class)]
class CalcEngineTest extends TestCase
{
    /**
     * Target design: parser extracts the operator and operands from a string.
     * This is a separate concern from the math itself.
     */
    public function test_parser_extracts_addition_from_string(): void
    {
        $result = CalcEngine::parseExpression("2 + 3");
        self::assertEquals(2.0, $result['operand_a']);
        self::assertEquals('+', $result['operator']);
        self::assertEquals(3.0, $result['operand_b']);
    }

    public function test_parser_extracts_multiplication_from_string(): void
    {
        $result = CalcEngine::parseExpression("10 * 5");
        self::assertEquals(10.0, $result['operand_a']);
        self::assertEquals('*', $result['operator']);
        self::assertEquals(5.0, $result['operand_b']);
    }

    /**
     * Target design: the parser should validate input format.
     */
    public function test_parser_throws_on_invalid_format(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        CalcEngine::parseExpression("2 + + 3");
    }

    /**
     * After refactoring, calcEngine should delegate to a separate Calculator class.
     * The calc engine itself should do no arithmetic.
     */
    public function test_calc_engine_returns_formatted_result_string(): void
    {
        $result = CalcEngine::calculate("2 + 3");
        self::assertEquals("Result: 5", $result);
    }

    public function test_calc_engine_returns_formatted_result_for_multiplication(): void
    {
        $result = CalcEngine::calculate("4 * 6");
        self::assertEquals("Result: 24", $result);
    }

    /**
     * After refactoring, calcEngine should delegate to a separate Formatter class.
     */
    public function test_calc_engine_returns_formatted_result_for_decimal(): void
    {
        $result = CalcEngine::calculate("1 / 4");
        self::assertEquals("Result: 0.25", $result);
    }
}
