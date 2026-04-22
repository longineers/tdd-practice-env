<?php

namespace Calc\SolidPractice;

use Exception;
use InvalidArgumentException;

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
    /**
     * @throws InvalidArgumentException
     */
    static function parseExpression(String $exp): array
    {
        $exp = trim($exp);
        if (empty($exp)) return [];

        $operand_a = substr($exp, 0, strpos($exp, ' '));
        $operator  = substr($exp, strpos($exp, ' ') + 1 , 1);
        $operand_b = substr($exp, strpos($exp, $operator) +1 );

        if (!is_numeric($operand_a)) throw new InvalidArgumentException();
        if (!is_numeric($operand_b)) throw new InvalidArgumentException();
        if (!in_array($operator, ['+','-','/','*'])) throw new InvalidArgumentException();

        return [
            'operand_a' => $operand_a,
            'operator' => $operator,
            'operand_b' => $operand_b
            ];
    }

    static function calculate($exp): string
    {
        try {
            return "Result: " . eval("return $exp;");
        } catch (Exception $ex) {
            return "Result: ";
        }
    }
}
