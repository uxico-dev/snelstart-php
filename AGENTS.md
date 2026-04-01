# AGENTS.md — SnelstartApiPHP

This file provides guidance for agentic coding agents working in this repository.

## Project Overview

A standalone PHP client library for the **Snelstart B2B accounting API**. No framework (no Laravel, no Symfony). Pure Composer library, PSR-4 autoloaded under the `SnelstartPHP` namespace. Minimum PHP version is **7.2**; avoid any PHP 8.0+ syntax (named arguments, union types, match expressions, constructor promotion, enums) to preserve compatibility.

---

## Directory Structure

```
src/
  Connector/      # Orchestration: calls Request builders + Mappers (V1 deprecated, V2 active)
  Exception/      # 10 custom exception classes
  Mapper/         # Response array → Model hydration (AbstractMapper + V2/ implementations)
  Model/          # Domain DTOs (V2/ active; V1/ deprecated)
  Request/        # PSR-7 request builders (BaseRequest + V2/ implementations)
  Secure/         # Auth: tokens, connections, connectors, BearerToken/
  Serializer/     # Model → array serialization for API write requests
tests/
  Mapper/         # Mapper unit tests
  Model/          # Model unit tests
  Request/        # Request builder tests (most coverage is here)
  stubs/          # Test stubs/fakes
```

---

## Commands

### Install dependencies
```bash
composer install
```

### Validate composer.json
```bash
composer validate --strict
```

### Lint PHP syntax (all source files)
```bash
find src tests -name '*.php' | xargs -n 1 -P4 php -l
```

### Run all tests
```bash
vendor/bin/phpunit --fail-on-risky
```

### Run a single test file
```bash
vendor/bin/phpunit tests/Request/V2/BoekingRequestTest.php
```

### Run a single test method
```bash
vendor/bin/phpunit --filter testAddInkoopboeking
# Or with class qualification:
vendor/bin/phpunit --filter 'BoekingRequestTest::testAddInkoopboeking'
```

### Static analysis — PHPStan (level 0)
```bash
vendor/bin/phpstan analyse --level 0 src tests
```

### Static analysis — Psalm
```bash
vendor/bin/psalm
```

---

## Testing

- **Framework:** PHPUnit 8.5 (configured in `phpunit.xml`)
- All tests extend `PHPUnit\Framework\TestCase`
- Test namespace root: `SnelstartPHP\Tests\`
- Use `$this->createMock()` for mocking — no third-party mock library
- PHPUnit strict mode is on: errors, notices, and warnings are converted to exceptions; output during tests fails the suite
- `setUp(): void` is used (not `@before` annotations)
- Test methods are prefixed with `test` (not `@test` annotation)

---

## Code Style

No automated fixer (no PHP-CS-Fixer, no PHPCS config). Follow the existing style as described below.

### PHP version compatibility
- Target **PHP 7.2+**. Do not use PHP 8.0+ features.
- No constructor promotion, no union types, no named arguments, no `match`, no `enum`.

### Strict types
- `declare(strict_types=1)` is present in some files but not all. Add it to new files you create; do not remove it from existing files.

### Namespace and autoloading
- Root namespace: `SnelstartPHP`
- Versioned sub-namespaces: `SnelstartPHP\Connector\V2`, `SnelstartPHP\Model\V2`, etc.
- Test namespace: `SnelstartPHP\Tests\...`
- PSR-4: `src/` maps to `SnelstartPHP\`, `tests/` maps to `SnelstartPHP\Tests\`

### Use / import statements
- One `use` statement per line
- Use namespace aliases to avoid verbose FQCNs in connectors and mappers:
  ```php
  use SnelstartPHP\Mapper\V2 as Mapper;
  use SnelstartPHP\Model\V2 as Model;
  use SnelstartPHP\Request\V2 as Request;
  ```
- Function imports may use a leading backslash: `use function \array_map;`

### Naming conventions
| Element | Convention | Example |
|---|---|---|
| Classes | PascalCase | `RelatieConnector`, `ODataRequestData` |
| Methods | camelCase | `findAll`, `setRelatiesoort` |
| Properties | camelCase | `$relatiesoort`, `$kredietLimiet` |
| Constants | UPPER_SNAKE_CASE | `MAX_RESULTS`, `FILTER_MODE_AND` |
| Test methods | `test` + camelCase | `testAddInkoopboeking` |
| Domain names | Dutch (match API) | `Relatie`, `Boeking`, `Grootboek` |

### Type hints and return types
- All public and most protected methods must have explicit parameter types and return type declarations
- Use nullable syntax: `?string`, `?UuidInterface`, `?Model\Relatie`
- Use `self` as return type on fluent setters
- Generators declared as `: \Generator`
- `void` on `setUp()` and methods with no meaningful return

### Properties and constructors
- Declare all properties explicitly as class-level fields with `@var` docblocks
- Assign in constructor body (no constructor promotion — PHP 7.2 compat)
- All setters return `self` for fluent chaining

### Arrays
- Always use short array syntax `[]`, never `array()`

### DocBlocks
- Every file must have the file-level docblock:
  ```php
  /**
   * @author  IntoWebDevelopment <info@intowebdevelopment.nl>
   * @project SnelstartApiPHP
   */
  ```
- Every property needs `@var Type`
- Use `@return Type[]` or `@psalm-return iterable<int, Type>` when returning collections
- Use `@throws ExceptionClass` on methods that throw
- Mark deprecated code with `@deprecated` and `@trigger_error(..., E_USER_DEPRECATED)`
- Use Psalm annotations where helpful: `@psalm-immutable`, `@template`, `@psalm-suppress`

### Error handling
- Use the custom exception hierarchy in `src/Exception/`:
  - `PreValidationException` — use static named constructors (`::unexpectedIdException()`, `::shouldHaveAnIdException()`)
  - `SnelstartApiErrorException` — use `::handleError(array $body): self` factory
  - `SnelstartApiAccessDeniedException` — use `::createFromParent($exception)` factory
- Connectors may silently catch `SnelstartResourceNotFoundException` and return `null` for `find()` methods
- Use `\trigger_error(..., E_USER_NOTICE)` for soft non-fatal warnings
- Avoid silent `catch` blocks except where intentional defensive coding is documented

### Models
- Every `Model\V2` class must define a `protected static array $editableAttributes` listing serializable field names; child classes merge parent attributes
- Use `SnelstartObject::createFromUUID(UuidInterface $uuid): self` for reference objects where only the ID is known

### Generators
- Use `yield` in `findAll` connectors and mappers for memory-efficient iteration over large result sets

---

## CI

GitHub Actions (`.github/workflows/tests.yml`) tests against:
- PHP: **7.2, 7.3, 7.4, 8.0, 8.1**
- Stability: **prefer-stable** and **prefer-lowest**

All of the following must pass before merging:
1. `composer validate --strict`
2. PHP lint (`php -l` on all files)
3. `vendor/bin/phpunit --fail-on-risky`
4. `vendor/bin/phpstan analyse --level 0 src tests`
