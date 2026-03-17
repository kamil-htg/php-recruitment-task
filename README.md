# URL Shortener -- Senior PHP Developer Live Coding Task

## Requirements

### Core (must complete)

1. **POST /api/shorten** -- Create a shortened URL
   - Request body: `{ "url": "https://code.claude.com/docs/en/overview" }`
   - Returns 201 with `{ "short_code": "abc123", "original_url": "https://...", "expires_at": "..." }`

2. **GET /api/evaluate/{shortCode}** -- Redirect to the original URL
   - Returns 302 redirect to the original URL
   - Returns 404 if the short code does not exist
   - Returns 410 Gone if the URL has expired

3. **URL Source Routing** -- Persist to the correct database based on the URL domain:
   - `https://code.claude.com/*` -> PostgreSQL
   - `https://ai.google.dev/*` -> MySQL
   - Any other domain -> reject with 422

4. **Validation**
   - URL must be a valid URL format
   - URL must be from a supported source
   - Missing or empty URL -> 422

5. **Expiration**
   - Expiration TTL is configured via the `URL_EXPIRATION_TTL` environment variable (in seconds, default: 2592000 = 30 days)
   - Every shortened URL gets an `expires_at` timestamp calculated from creation time + TTL
   - Expired URLs return 410 Gone on redirect

## Useful Commands

```bash
make start                    # Build, start containers, install dependencies
make down                     # Stop containers
make test                     # Run tests
make shell                    # Enter PHP container
make db-create                # Create dev databases
make db-create-test           # Create test databases
make migrate                  # Run migrations on both connections
make migrate-diff             # Generate migration diffs for both connections
make migrate-test             # Run migrations on test databases
```

## Time

You have approximately **90 minutes**. Focus on the core requirements first. Clean, working code with tests passing is valued over incomplete stretch goals.
