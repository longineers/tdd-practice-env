<?php

namespace Calc\SolidPractice;

/**
 * Calculator uses hardcoded operations as private static methods.
 * Adding a new operation means editing this file — violating Open/Closed.
 *
 * This pattern is common in production code. When a new requirement comes
 * in ("we need power and modulo too"), the developer reaches for match()
 * and adds cases. The class grows, and every test for existing operations
 * must be rerun to make sure nothing broke.
 */
class Calculator
{
    private array $operations = ['add', 'subtract', 'multiply'];

    public function __construct(array $operations = [])
    {
        if (!empty($operations)) {
            $this->operations = $operations;
        }
    }

    public function execute(string $operation, float $a, float $b): float
    {
        if (!in_array($operation, $this->operations)) {
            throw new \InvalidArgumentException("Unsupported operation: $operation");
        }

        return match ($operation) {
            'add' => $a + $b,
            'subtract' => $a - $b,
            'multiply' => $a * $b,
            'divide' => $b === 0 ? 0.0 : $a / $b,
        };
    }

    /**
     * These are the hardcoded operations — each one is a modification
     * to this class. New operations require editing it.
     */
    private function add(float $a, float $b): float
    {
        return $a + $b;
    }

    private function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    private function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    private function divide(float $a, float $b): float
    {
        return $b === 0 ? 0.0 : $a / $b;
    }
}
