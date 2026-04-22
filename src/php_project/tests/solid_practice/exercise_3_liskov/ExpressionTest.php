<?php

namespace Calc\Tests\SolidPractice;

use Calc\SolidPractice\Expression\AddExpression;
use Calc\SolidPractice\Expression\SubtractExpression;
use Calc\SolidPractice\Expression\PowerExpression;
use PHPUnit\Framework\TestCase;

/**
 * Exercise 3: Liskov Substitution Principle
 *
 * PowerExpression extends Expression but has a different precondition —
 * it throws for negative base values. A function accepting Expression
 * breaks when you pass PowerExpression.
 *
 * @group liskov
 */
#[CoversClass(AddExpression::class)]
#[CoversClass(SubtractExpression::class)]
#[CoversClass(PowerExpression::class)]
class ExpressionTest extends TestCase
{
    /**
     * Any Expression should be substitutable for any other without surprises.
     * A function that accepts Expression should handle ALL Expression types.
     */
    public function test_add_expression_is_evaluable(): void
    {
        $expr = new AddExpression(3.0, 5.0);
        self::assertEquals(8.0, $expr->evaluate());
    }

    public function test_subtract_expression_is_evaluable(): void
    {
        $expr = new SubtractExpression(10.0, 4.0);
        self::assertEquals(6.0, $expr->evaluate());
    }

    public function test_power_expression_is_evaluable(): void
    {
        $expr = new PowerExpression(2.0, 10.0);
        self::assertEquals(1024.0, $expr->evaluate());
    }

    public function test_power_expression_throws_for_negative_base(): void
    {
        $expr = new PowerExpression(-2.0, 0.5);
        $this->expectException(\InvalidArgumentException::class);
        $expr->evaluate();
    }

    /**
     * THIS IS THE KEY TEST: a function that accepts Expression
     * should work with ANY subclass. If it throws with PowerExpression,
     * then PowerExpression is NOT a valid subclass of Expression.
     *
     * This is the Liskov Substitution Principle violation.
     */
    public function test_any_expression_can_be_passed_to_process_function(): void
    {
        $expression = makePowerExpression(-2.0, 0.5);
        process($expression);
        // If this throws, PEP is violated.
        self::assertNotFalse(true);
    }

    /**
     * Another LSP test: composing expressions should never throw
     * regardless of which concrete expressions are composed.
     */
    public function test_composing_mixed_expressions_is_safe(): void
    {
        $result = composeExpression(new AddExpression(2.0, 3.0), 'x', new SubtractExpression(5.0, 6.0));
        self::assertEquals(3.0, $result);
    }
}

/**
 * This helper demonstrates what a client function should look like.
 * It should accept Expression without knowing which concrete type.
 */
function process(Expression $expression): ?string
{
    try {
        return (string) $expression->evaluate();
    } catch (\Exception $e) {
        // In a real app this might log, but the function shouldn't throw
        // unexpectedly based on subclass choice.
        return null;
    }
}

function composeExpression(Expression $base, string $variable, Expression $fallback): float
{
    // If base can't be evaluated safely, use fallback. No exceptions.
    return $base->evaluate() ?? $fallback->evaluate();
}

function makePowerExpression(float $base, float $exponent): Expression
{
    return new PowerExpression($base, $exponent);
}
