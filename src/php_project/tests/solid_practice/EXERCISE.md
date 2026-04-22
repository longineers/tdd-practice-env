# SOLID Principles Practice in PHP

5 progressive TDD exercises. Each exercise gives you a realistic violation + tests that drive the refactoring step by step.

## Prerequisites

Make sure your containers are up:
```bash
cd /Users/long/Dev/tdd-practice-env
./scripts/up
```

## Running Tests

```bash
./scripts/test-php                        # run all SOLID exercises
./scripts/test-php --group=srp            # Exercise 1 only
./scripts/test-php --group=openclosed     # Exercise 2 only
./scripts/test-php --group=liskov         # Exercise 3 only
./scripts/test-php --group=iesp           # Exercise 4 only
./scripts/test-php --group=dip            # Exercise 5 only
./scripts/test-php --group=capstone       # Capstone only
```

Each exercise lives in its own directory under `tests/solid_practice/`. Your implementations go in `src/solid_practice/`.

## How This Works

Each exercise has two files:
- A **broken implementation** in `src/solid_practice/` that violates one principle
- A **test file** that shows what the refactored design should support

Your job:
1. Read the exercise description below
2. Write your first failing test (you can modify the existing test file or create new ones)
3. Write the minimal implementation to make it pass
4. Verify — `./scripts/test-php --group=exercise_N`
5. Repeat until the design is clean

## General Rules

- Write tests *before* implementation — Red → Green → Refactor
- Each exercise is self-contained
- Don't look ahead to the next exercise — focus on the one you're in
- The broken scaffolds are realistic, not cartoonish. They could be real production code.

---

## Exercise 1 — Single Responsibility Principle

**The Violation**: `CalcEngine` parses input strings, computes math, formats results, and logs output — all in one class. Four responsibilities, four reasons to change.

**The Goal**: Refactor into separate classes, each with a single reason to change. Write tests that prove each class does its job independently.

**Your target design**:
- `ExpressionParser` — parses strings like `"2 + 3"` into numeric components
- `Calculator` — pure math operations
- `ResultFormatter` — formats output for display
- `CalcEngine` — orchestrates the three above (thin glue)

**Start here**: Run `./scripts/test-php --group=srp` to see the failing tests. The broken `CalcEngine.php` is your starting point.

---

## Exercise 2 — Open/Closed Principle

**The Violation**: `Calculator` requires editing its source code every time you want to add a new operation (square root, modulo, exponentiation). Add → Edit → Test → Deploy cycle for every new feature.

**The Goal**: Design a system where adding new operations requires no changes to existing code. New operations = new classes, zero touching of `Calculator`.

**Your target design**:
- `Operation` interface with `execute(float $a, float $b): float`
- `Add`, `Subtract`, `Multiply`, `Divide`, `Power` as concrete operations
- `Calculator` delegates to whatever `Operation` you give it

**Start here**: Run `./scripts/test-php --group=openclosed`. The existing `Calculator.php` is your starting point.

---

## Exercise 3 — Liskov Substitution Principle

**The Violation**: You have an `Expression` hierarchy. `PowerExpression extends Expression` has a different precondition (base must be non-negative) than `AddExpression`. A function accepting `Expression` breaks when you pass `PowerExpression`.

**The Goal**: Design an `Expression` hierarchy where any concrete `Expression` can be used anywhere `Expression` is expected, without assertions or unexpected exceptions.

**Your target design**:
- `Expression` interface with `evaluate(): float`
- Concrete expressions (`Add`, `Subtract`, `Multiplication`, `Power`) that honor shared invariants
- All subclasses fully substitutable

**Start here**: Run `./scripts/test-php --group=liskov`. The broken hierarchy is your starting point.

---

## Exercise 4 — Interface Segregation Principle

**The Violation**: A monolithic `ICalculator` interface forces every implementer to provide methods they don't need. The `ExpressionCalculator` has to implement `format()`. The `LoggingCalculator` has to implement `parse()`. Nobody benefits from the bloated contract.

**The Goal**: Split into focused interfaces matching each client's actual needs. Prove each client only depends on what it uses.

**Your target design**:
- `IExpression` — `evaluate(): float`
- `IFormatter` — `format(float $result): string`
- `IInputParser` — `parse(string $input): array`
- Clients implement only the interface they need

**Start here**: Run `./scripts/test-php --group=iesp`. The bloated `ICalculator` is your starting point.

---

## Exercise 5 — Dependency Inversion Principle

**The Violation**: `Calculator` instantiates a `FileLogger` internally. You can't mock it for tests, can't swap logging at runtime, and the calculator is tightly coupled to filesystem I/O.

**The Goal**: `Calculator` depends only on an `ILogger` interface, injected via constructor. The concrete logger is wired at the system's boundaries.

**Your target design**:
- `ILogger` interface with `log(string $message): void`
- `FileLogger` and `MemoryLogger` implement `ILogger`
- `Calculator` receives `ILogger` via constructor — zero filesystem knowledge

**Start here**: Run `./scripts/test-php --group=dip`. The broken coupling is your starting point.

---

## Capstone — All Five Principles Together

After completing all 5 exercises, you're ready for the real challenge.

**The Task**: Refactor the original `Calculator` in `src/Calculator.php` to be a production-grade math engine that handles:
- Multiple input formats (strings like `"2 + 3"`, `"10 * 5"`, and direct numeric calls)
- Pluggable math operations (add, subtract, multiply, divide, power, modulo)
- Pluggable output formatting (plain, decimal, scientific)
- Pluggable logging/memory tracking
- Full test coverage proving all 5 principles hold

**What to do**:
1. Write tests in `tests/solid_practice/capstone/`
2. Implementation in `src/solid_practice/CapstoneEngine.php`
3. Run: `./scripts/test-php --group=capstone`

### Summary Reference

| Principle | Rule | Tell |
|---|---|---|
| **S**ingle Responsibility | One reason to change | "Why would this class need to be modified?" |
| **O**pen/Closed | Extension > Modification | "Do I need to touch existing code?" |
| **L**iskov Substitution | Subclasses honor contracts | "If I swap a subclass, does anything break?" |
| **I**nterface Segregation | Clients only see what they use | "Does a client implement methods it never calls?" |
| **D**ependency Inversion | Depend on abstractions | "Does this class know about concrete classes it should?" |
