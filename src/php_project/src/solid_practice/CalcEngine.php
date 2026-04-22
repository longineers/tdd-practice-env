<?php

namespace Calc\SolidPractice;

/**
 * CalcEngine does everything: parsing, computing, formatting, and logging.
 * Four responsibilities in one class — a textbook SRP violation.
 *
 * This code works fine for a simple app. But when the logging format changes,
 * the parser breaks. When the output needs decimals, the calc logic changes.
 * Every change ripples through the whole class.
 */
class CalcEngine
{
    public static function parseExpression(string $input): array
    {
        // Parsing + computation + formatting + logging all in one method.
        $parts = preg_split('/\s+/', trim($input));
        if (count($parts) !== 3) {
            throw new \InvalidArgumentException("Invalid expression format.");
        }
        $operand_a = (float) $parts[0];
        $operator = $parts[1];
        $operand_b = (float) $parts[2];

        // Computation mixed with parsing — why?
        $result = match ($operator) {
            '+' => $operand_a + $operand_b,
            '-' => $operand_a - $operand_b,
            '*' => $operand_a * $operand_b,
            '/' => $operand_b === 0 ? 0.0 : $operand_a / $operand_b,
            default => throw new \InvalidArgumentException("Unknown operator: $operator"),
        };

        // Formatting mixed in — what if the output format changes?
        $formatted = "Result: " . (is_int($result) ? (string) $result : rtrim(rtrim(number_format($result, 2), '0'), '.'));

        // Logging mixed in — what if the logging target changes?
        file_put_contents('/tmp/calc.log', "[$formatted]\n", FILE_APPEND);

        return [
            'operand_a' => $operand_a,
            'operator' => $operator,
            'operand_b' => $operand_b,
            'result' => $formatted,
        ];
    }

    public static function calculate(string $input): string
    {
        $parsed = self::parseExpression($input);
        return $parsed['result'];
    }
}
