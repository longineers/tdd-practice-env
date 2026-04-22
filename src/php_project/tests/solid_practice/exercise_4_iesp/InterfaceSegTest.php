<?php

namespace Calc\Tests\SolidPractice;

use Calc\SolidPractice\ICalculator;
use Calc\SolidPractice\ExpressionCalculator;
use Calc\SolidPractice\LoggingCalculator;
use PHPUnit\Framework\TestCase;

/**
 * Exercise 4: Interface Segregation Principle
 *
 * ICalculator requires every implementer to provide format(),
 * parse(), log(), AND compute(). Nobody needs all four methods.
 *
 * @group iesp
 */
#[CoversClass(ICalculator::class)]
#[CoversClass(ExpressionCalculator::class)]
#[CoversClass(LoggingCalculator::class)]
class InterfaceSegTest extends TestCase
{
    public function test_expressions_only_need_evaluate(): void
    {
        $calculator = new ExpressionCalculator();
        self::assertEquals(8.0, $calculator->evaluateExpression(3.0, 5.0, 'add'));
    }

    public function test_formatter_only_needs_format(): void
    {
        $calculator = new LoggingCalculator();
        $logged = [];
        CalculatorLoggerFactory::logInto($logged);
        $calculator = new LoggingCalculator($logged);
        $result = $calculator->compute(10.0, 2.0, 'multiply');
        self::assertEquals(20.0, $result);
        self::assertCount(1, $logged);
    }

    public function test_each_client_implements_only_what_it_uses(): void
    {
        $expressionCalculator = new ExpressionCalculator();
        // ExpressionCalculator should NOT need to implement parse(), format(), or log()
        // It implements only IExpression.

        // LoggingCalculator should NOT need to implement evaluateExpression()
        // It implements only ILoggingCalculator.
    }
}

// --- Stub reference below shows the current bloated ICalculator that needs splitting.

interface ICalculator
{
    public function evaluateExpression(float $a, float $b, string $operation): float;
    public function parseInput(string $input): array;
    public function formatOutput(float $result): string;
    public function log(string $message): void;
    public function compute(float $a, float $b, string $operation): float;
}

class ExpressionCalculator implements ICalculator
{
    public function evaluateExpression(float $a, float $b, string $operation): float
    {
        return match ($operation) {
            'add' => $a + $b,
            'subtract' => $a - $b,
            default => throw new \InvalidArgumentException("Unknown operation: $operation"),
        };
    }

    // This is irrelevant to ExpressionCalculator but required by ICalculator:
    public function parseInput(string $input): array { return []; }
    public function formatOutput(float $result): string { return (string) $result; }
    public function log(string $message): void {}
    public function compute(float $a, float $b, string $operation): float
    {
        return $this->evaluateExpression($a, $b, $operation);
    }
}

class LoggingCalculator implements ICalculator
{
    private array $logs = [];

    public function __construct(array $logs = [])
    {
        $this->logs = $logs;
    }

    public function compute(float $a, float $b, string $operation): float
    {
        $result = match ($operation) {
            'multiply' => $a * $b,
            default => throw new \InvalidArgumentException("Unknown operation: $operation"),
        };
        $this->log("Computed: $a $operation $b = $result");
        return $result;
    }

    public function log(string $message): void
    {
        $this->logs[] = $message;
    }

    // These are irrelevant to LoggingCalculator but required by ICalculator:
    public function evaluateExpression(float $a, float $b, string $operation): float
    {
        throw new \RuntimeException("Not implemented — ICalculator forces this method.");
    }

    public function parseInput(string $input): array { return []; }
    public function formatOutput(float $result): string { return (string) $result; }
}

// --- Testing helpers ---
class CalculatorLoggerFactory
{
    public static function logInto(array &$logs): void
    {
        // Helper that populates $logs — used by tests
    }
}
