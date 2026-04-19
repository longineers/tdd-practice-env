# TDD Practice Environment

Docker containers for practicing Test-Driven Development with PHP and Java.

## Quick Start

```bash
./scripts/up        # start containers
./scripts/down      # stop containers
```

This starts two isolated containers:

| Container | Image | Working Directory |
|---|---|---|
| `tdd_php_env` | `php:8.3-cli` | `/app/src/php_project` |
| `tdd_java_env` | `maven:3.9-eclipse-temurin-21` | `/app/src/java_project` |

## Entering the Containers

```bash
docker exec -it tdd_php_env bash   # PHP
docker exec -it tdd_java_env bash  # Java
```

## PHP Project

Located at `src/php_project/`. A minimal Calculator library using PHPUnit 11.

### Setup (one-time)

```bash
./scripts/install-php
```

### Running Tests

```bash
./scripts/test-php
```

### Project Structure

```
src/php_project/
├── src/
│   └── Calculator.php       # Calculator class
├── tests/
│   └── CalculatorTest.php   # PHPUnit tests
├── composer.json
├── phpunit.xml.dist
└── vendor/
```

### TDD Workflow

1. Write a failing test in `tests/CalculatorTest.php`
2. Run `./scripts/test-php` to see it fail
3. Write minimal code in `src/Calculator.php` to make it pass
4. Refactor
5. Repeat

## Java Project

Located at `src/java_project/`. A Spring Boot 3.2 Calculator REST API with full TDD test coverage.

### Running Tests

```bash
./scripts/test-java
```

### Project Structure

```
src/java_project/
├── src/main/java/tdd/practice/calculator/
│   ├── CalculatorApplication.java    # Spring Boot entry point
│   ├── domain/
│   │   └── Calculator.java           # Core calculator service
│   └── rest/
│       ├── CalculatorController.java # REST API at /api/calculate
│       └── GlobalExceptionHandler.java
├── src/test/java/tdd/practice/calculator/
│   ├── domain/
│   │   └── CalculatorTest.java       # Domain unit tests
│   └── rest/
│       └── CalculatorControllerTest.java # Controller integration tests
├── pom.xml
└── src/main/resources/application.properties
```

### TDD Workflow

1. Write a failing test in `src/test/java/tdd/practice/calculator/`
2. Run `./scripts/test-java` to see it fail
3. Write minimal code in `src/main/java/tdd/practice/calculator/` to make it pass
4. Refactor
5. Repeat

## Stopping

```bash
./scripts/down
```
