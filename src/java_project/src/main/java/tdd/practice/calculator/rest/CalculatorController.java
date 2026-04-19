package tdd.practice.calculator.rest;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import tdd.practice.calculator.domain.Calculator;

import java.util.Map;

/**
 * REST controller exposing calculator operations as HTTP endpoints.
 *
 * Example endpoints:
 * <pre>
 * GET /api/calculate?operation=add&a=2&b=3
 * → {"result": 5.0}
 * </pre>
 */
@RestController
@RequestMapping("/api/calculate")
public class CalculatorController {

    private final Calculator calculator;

    public CalculatorController(Calculator calculator) {
        this.calculator = calculator;
    }

    @GetMapping
    public ResponseEntity<Map<String, Double>> calculate(
            @RequestParam String operation,
            @RequestParam double a,
            @RequestParam double b) {

        double result = switch (operation.toLowerCase()) {
            case "add" -> calculator.add(a, b);
            case "subtract" -> calculator.subtract(a, b);
            case "multiply" -> calculator.multiply(a, b);
            case "divide" -> calculator.divide(a, b);
            default -> throw new IllegalArgumentException("Unknown operation: " + operation);
        };

        return ResponseEntity.ok(Map.of("result", result));
    }
}
