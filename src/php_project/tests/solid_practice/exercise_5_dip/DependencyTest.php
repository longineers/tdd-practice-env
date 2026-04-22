<?php

namespace Calc\Tests\SolidPractice;

use Calc\SolidPractice\ILogger;
use Calc\SolidPractice\Calculator;
use PHPUnit\Framework\TestCase;

/**
 * Exercise 5: Dependency Inversion Principle
 *
 * Calculator creates FileLogger internally. The dependency flows
 * downward (Calculator → FileLogger) instead of upward.
 * Can't mock logging in tests. Can't swap logging at runtime.
 *
 * @group dip
 */
#[CoversClass(Calculator::class)]
class DependencyTest extends TestCase
{
    public function test_can_inject_mock_logger(): void
    {
        $logged = [];
        $mockLogger = new class($logged) implements ILogger {
            private array $logs;
            public function __construct(array &$logs) { $this->logs = &$logs; }
            public function log(string $message): void { $this->logs[] = $message; }
        };

        $calculator = new Calculator($mockLogger);
        $result = $calculator->add(2.0, 3.0);

        self::assertEquals(5.0, $result);
        self::assertCount(1, $this->captureMocksFor($logged, $mockLogger));
    }

    public function test_calculator_works_without_filesystem(): void
    {
        $logged = [];
        $calculator = new Calculator(new class($logged) implements ILogger {
            private array $logs;
            public function __construct(array &$logs) { $this->logs = &$logs; }
            public function log(string $message): void { $this->logs[] = $message; }
        });

        $this->assertEquals(5.0, $calculator->add(2.0, 3.0));
        $this->assertEquals(-1.0, $calculator->subtract(2.0, 3.0));
    }

    public function test_addition_is_logged(): void
    {
        $logged = [];
        $calculator = new Calculator(new class($logged) implements ILogger {
            private array $logs;
            public function __construct(array &$logs) { $this->logs = &$logs; }
            public function log(string $message): void { $this->logs[] = $message; }
        });

        $calculator->add(2.0, 3.0);
        $this->assertCount(1, $logged);
    }

    public function test_subtraction_is_logged(): void
    {
        $logged = [];
        $calculator = new Calculator(new class($logged) implements ILogger {
            private array $logs;
            public function __construct(array &$logs) { $this->logs = &$logs; }
            public function log(string $message): void { $this->logs[] = $message; }
        });

        $calculator->subtract(10.0, 4.0);
        $this->assertCount(1, $logged);
    }

    public function test_calculator_uses_injected_logger_not_filesystem(): void
    {
        // The key test: if the calculator writes to filesystem, this test
        // should NOT depend on a real file existing. It only checks the
        // logger interface was used.
        $logged = [];
        $calculator = new Calculator(new class($logged) implements ILogger {
            private array $logs;
            public function __construct(array &$logs) { $this->logs = &$logs; }
            public function log(string $message): void { $this->logs[] = $message; }
        });

        $result = $calculator->add(2.0, 3.0);
        self::assertEquals(5.0, $result);
        self::assertEquals(1, count($logged));
    }

    private function captureMocksFor(array &$logs, $mock): array
    {
        return $logs;
    }
}
