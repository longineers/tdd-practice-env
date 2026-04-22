<?php

namespace Calc\SolidPractice;

/**
 * Calculator creates FileLogger internally.
 *
 * Problem: you can't mock FileLogger in tests. You can't swap the
 * logging strategy at runtime. The calculator is tightly coupled
 * to filesystem I/O even though it should only care about math.
 */
class Calculator
{
    private ILogger $logger;

    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    public function add(float $a, float $b): float
    {
        $result = $a + $b;
        $this->logger->log("Added: $a + $b = $result");
        return $result;
    }

    public function subtract(float $a, float $b): float
    {
        $result = $a - $b;
        $this->logger->log("Subtracted: $a - $b = $result");
        return $result;
    }

    public function multiply(float $a, float $b): float
    {
        $result = $a * $b;
        $this->logger->log("Multiplied: $a * $b = $result");
        return $result;
    }
}
