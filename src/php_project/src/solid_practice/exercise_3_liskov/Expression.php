<?php

namespace Calc\SolidPractice\Expression;

interface Expression
{
    public function evaluate(): ?float;
}

class AddExpression implements Expression
{
    public function __construct(
        private float $a,
        private float $b,
    ) {}

    public function evaluate(): ?float
    {
        return $this->a + $this->b;
    }
}

class SubtractExpression implements Expression
{
    public function __construct(
        private float $a,
        private float $b,
    ) {}

    public function evaluate(): ?float
    {
        return $this->a - $this->b;
    }
}

/**
 * PowerExpression throws for negative base values.
 * This is a precondition that AddExpression and SubtractExpression
 * don't have. It violates LSP: this subclass imposes constraints
 * that the parent contract doesn't account for.
 */
class PowerExpression implements Expression
{
    public function __construct(
        private float $base,
        private float $exponent,
    ) {}

    public function evaluate(): ?float
    {
        // This precondition isn't shared by other subclasses.
        if ($this->base < 0 && fmod($this->exponent, 1.0) !== 0.0) {
            throw new \InvalidArgumentException("Negative real root is not supported.");
        }
        return pow($this->base, $this->exponent);
    }
}
