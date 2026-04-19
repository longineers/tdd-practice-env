<?php

namespace Calc;

/**
 * A simple calculator with basic arithmetic operations.
 */
class Calculator
{
    /**
     * Add two numbers.
     */
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }

    /**
     * Subtract two numbers (b from a).
     */
    public function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    /**
     * Multiply two numbers.
     */
    public function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    /**
     * Divide two numbers.
     *
     * @throws \InvalidArgumentException If divisor is zero.
     */
    public function divide(float $a, float $b): float
    {
        if ($b === 0.0) {
            throw new \InvalidArgumentException('Division by zero is not allowed.');
        }
        return $a / $b;
    }
}
