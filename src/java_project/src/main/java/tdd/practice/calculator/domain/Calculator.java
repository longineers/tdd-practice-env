package tdd.practice.calculator.domain;

import org.springframework.stereotype.Service;

/**
 * Core calculator service with basic arithmetic operations.
 * Pure domain logic, registered as a Spring bean.
 *
 * Example:
 * <pre>
 * Calculator calc = new Calculator();
 * double result = calc.add(2, 3); // returns 5.0
 * </pre>
 */
@Service
public class Calculator {

    /**
     * Add two numbers.
     */
    public double add(double a, double b) {
        return a + b;
    }

    /**
     * Subtract b from a.
     */
    public double subtract(double a, double b) {
        return a - b;
    }

    /**
     * Multiply two numbers.
     */
    public double multiply(double a, double b) {
        return a * b;
    }

    /**
     * Divide a by b.
     *
     * @throws ArithmeticException if divisor is zero
     */
    public double divide(double a, double b) {
        if (b == 0.0) {
            throw new ArithmeticException("Division by zero is not allowed.");
        }
        return a / b;
    }
}
