# URL Shortener -- Senior PHP Developer Live Coding Task

Build a URL shortener API using Symfony. The application accepts URLs from configured domains and persists each to a different database based on the domain.
A test suite is provided in `tests/` -- all tests are currently failing and your goal is to make them pass.

The controller skeleton and entity are already provided. Your job is the architecture and logic, not the scaffolding.

---

## Requirements

### Endpoints

1. **POST /api/shorten** -- Create a shortened URL
   - Request body: `{ "url": "https://code.claude.com/docs/en/overview" }`
   - Returns 201 with `{ "id": 1, "short_code": "abc123", "original_url": "https://...", "expires_at": "..." }`

2. **GET /api/evaluate/{shortCode}** -- Redirect to the original URL
   - Returns 302 redirect to the original URL
   - Returns 404 if the short code does not exist
   - Returns 410 Gone if the URL has expired

### Validation Rules

- URL must be a valid URL format
- URL must be from a configured source
- Missing or empty URL -> 422

### What's Already Provided

- `src/Controller/UrlShortenerController.php` -- Route skeleton (returns 501, fill in the logic)
- `src/Entity/ShortenedUrl.php` -- Fully mapped entity
- Doctrine config with dual entity managers (`postgresql`, `mysql`)
- Docker setup with both databases
- Failing test suite in `tests/`

### What You Build

- Service layer with domain routing logic
- Repository / persistence orchestration
- Validation (your choice of approach)
- Short code generation
- Expiration handling
- The `testEvaluateWithExpiredUrlReturns410` test (marked as skipped -- implement it)

---

## Architecture Decisions

Before writing code, discuss your approach to each of these:

### Decision 1: Domain Routing Strategy

The Doctrine config has two entity managers (`postgresql`, `mysql`). The system must route URLs to the correct database based on domain:
- `https://code.claude.com/*` -> PostgreSQL
- `https://ai.google.dev/*` -> MySQL
- Any other domain -> reject with 422

**The list of supported domains and their target databases must be configurable** (e.g., via a Symfony parameter or YAML config). Adding a third domain should require zero code changes -- only configuration.

Design the mechanism that maps a URL to the correct persistence layer.

### Decision 2: Validation

Where does validation live? What validates the URL format vs. what validates the domain is supported? Consider: if we add a third supported domain next week via config, does your validation still work without code changes?

### Decision 3: Short Code Generation

How will you generate short codes? What guarantees do you need (uniqueness, length, character set)? What happens on collision?

### Decision 4: Expiration & Testability

The expiration TTL comes from `URL_EXPIRATION_TTL` env var (in seconds, default: 2592000 = 30 days). Every shortened URL gets an `expires_at` timestamp.

How do you make the expiration logic testable without manipulating real time?

---

## Useful Commands

```bash
make start                    # Build, start containers, install dependencies
make stop                     # Stop containers
make test                     # Run tests
make shell                    # Enter PHP container
make db-create                # Create dev databases
make db-create-test           # Create test databases
make migrate                  # Run migrations on both connections
make migrate-test             # Run migrations on test databases
```
