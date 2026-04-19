package tdd.practice.calculator.domain;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Nested;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

/**
 * TDD-driven unit tests for Calculator domain class.
 * Written Test-First approach: tests define the contract, implementation follows.
 */
class CalculatorTest {

    private Calculator calculator;

    @BeforeEach
    void setUp() {
        calculator = new Calculator();
    }

    @Nested
    @DisplayName("Addition")
    class AdditionTests {

        @Test
        @DisplayName("should add two positive numbers")
        void shouldAddTwoPositiveNumbers() {
            assertEquals(5.0, calculator.add(2.0, 3.0));
        }

        @Test
        @DisplayName("should add zero and positive number")
        void shouldAddZeroAndPositive() {
            assertEquals(3.0, calculator.add(0.0, 3.0));
        }

        @Test
        @DisplayName("should add two negative numbers")
        void shouldAddTwoNegativeNumbers() {
            assertEquals(-5.0, calculator.add(-2.0, -3.0));
        }

        @Test
        @DisplayName("should add negative and positive numbers to zero")
        void shouldAddToZero() {
            assertEquals(0.0, calculator.add(-1.0, 1.0));
        }

        @Test
        @DisplayName("should add floating point numbers")
        void shouldAddFloatingPointNumbers() {
            assertEquals(0.3, calculator.add(0.1, 0.2), 1e-10);
        }
    }

    @Nested
    @DisplayName("Subtraction")
    class SubtractionTests {

        @Test
        @DisplayName("should subtract two positive numbers")
        void shouldSubtractTwoPositiveNumbers() {
            assertEquals(1.0, calculator.subtract(3.0, 2.0));
        }

        @Test
        @DisplayName("should produce negative result when subtrahend is larger")
        void shouldProduceNegativeResult() {
            assertEquals(-2.0, calculator.subtract(1.0, 3.0));
        }

        @Test
        @DisplayName("should return zero when subtracting same values")
        void shouldReturnZero() {
            assertEquals(0.0, calculator.subtract(5.0, 5.0));
        }

        @Test
        @DisplayName("should subtract zero — return original value")
        void shouldSubtractZero() {
            assertEquals(7.0, calculator.subtract(7.0, 0.0));
        }
    }

    @Nested
    @DisplayName("Multiplication")
    class MultiplicationTests {

        @Test
        @DisplayName("should multiply two positive numbers")
        void shouldMultiplyTwoPositiveNumbers() {
            assertEquals(6.0, calculator.multiply(2.0, 3.0));
        }

        @Test
        @DisplayName("should multiply with negative number")
        void shouldMultiplyWithNegativeNumber() {
            assertEquals(-6.0, calculator.multiply(-2.0, 3.0));
        }

        @Test
        @DisplayName("should return zero when multiplying by zero")
        void shouldReturnZero() {
            assertEquals(0.0, calculator.multiply(0.0, 100.0));
        }

        @Test
        @DisplayName("should multiply two negative numbers — positive result")
        void shouldMultiplyTwoNegativeNumbers() {
            assertEquals(6.0, calculator.multiply(-2.0, -3.0));
        }

        @Test
        @DisplayName("should multiply floating point numbers")
        void shouldMultiplyFloatingPointNumbers() {
            assertEquals(0.6, calculator.multiply(0.2, 3.0), 1e-10);
        }
    }

    @Nested
    @DisplayName("Division")
    class DivisionTests {

        @Test
        @DisplayName("should divide two positive numbers")
        void shouldDivideTwoPositiveNumbers() {
            assertEquals(2.0, calculator.divide(6.0, 3.0));
        }

        @Test
        @DisplayName("should produce negative result with mixed signs")
        void shouldProduceNegativeResult() {
            assertEquals(-2.0, calculator.divide(6.0, -3.0));
        }

        @Test
        @DisplayName("should return zero when dividend is zero")
        void shouldReturnZeroWhenDividendIsZero() {
            assertEquals(0.0, calculator.divide(0.0, 5.0));
        }

        @Test
        @DisplayName("should divide with remainder — return double")
        void shouldDivideWithRemainder() {
            assertEquals(1.5, calculator.divide(3.0, 2.0), 1e-10);
        }

        @Test
        @DisplayName("should throw ArithmeticException when dividing by zero")
        void shouldThrowWhenDividingByZero() {
            ArithmeticException exception = assertThrows(
                    ArithmeticException.class,
                    () -> calculator.divide(1.0, 0.0)
            );
            assertEquals("Division by zero is not allowed.", exception.getMessage());
        }

        @Test
        @DisplayName("should throw for dividing by positive zero")
        void shouldThrowForPositiveZero() {
            assertThrows(ArithmeticException.class, () -> calculator.divide(1.0, 0.0));
        }

        @Test
        @DisplayName("should throw for dividing by negative zero")
        void shouldThrowForNegativeZero() {
            assertThrows(ArithmeticException.class, () -> calculator.divide(1.0, -0.0));
        }
    }

    @Nested
    @DisplayName("Edge Cases")
    class EdgeCaseTests {

        @Test
        @DisplayName("should handle very large numbers — return infinity on overflow")
        void shouldHandleLargeNumbers() {
            double result = calculator.multiply(1e200, 1e200);
            assertTrue(Double.isInfinite(result));
        }

        @Test
        @DisplayName("should handle very small numbers — return denormalized value")
        void shouldHandleSmallNumbers() {
            double result = calculator.multiply(1e-150, 1e-150);
            assertEquals(1e-300, result);
        }

        @Test
        @DisplayName("should handle subtraction with large negative result")
        void shouldHandleLargeNegativeResult() {
            double result = calculator.subtract(-1e150, 1e150);
            assertEquals(-2e150, result);
        }
    }
}
