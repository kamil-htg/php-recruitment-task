# Task: Typed Collections

## Context

The codebase contains three DTOs:

- `App\NotRelevant\DTO\Apple` — represents an apple with a variety and weight
- `App\NotRelevant\DTO\Banana` — represents a banana with a length and ripeness flag
- `App\NotRelevant\DTO\Basket` — groups a set of apples and bananas under a label
- `App\NotRelevant\DTO\....` — expect more item (and collections) to be added in the future

Currently `Basket` holds its fruit as plain untyped arrays. Your task is to build typed collections and wire them in.

---

## Requirements

### 1. Implement `AppleCollection`

File: `src/NotRelevant/Collection/AppleCollection.php`

The class must implement `\Countable` and `\IteratorAggregate`.

| Method | Behaviour                                                                                                            |
|---|----------------------------------------------------------------------------------------------------------------------|
| `add(object $item): static` | Throws `\InvalidArgumentException` when passed object is different than `Apple`. Returns the same instance (fluent). |
| `toArray(): array` | Returns a plain `array<Apple>` of all items.                                                                         |
| `first(): ?Apple` | Returns the first item, or `null` when the collection is empty.                                                      |
| `filter(callable $condition): static` | Returns a **new** `AppleCollection` containing only items for which `$condition` returns `true`.                     |
| `map(callable $transform): array` | Applies `$transform` to each item and returns the results as a plain array.                                          |

### 2. Implement `BananaCollection`

File: `src/NotRelevant/Collection/BananaCollection.php`

Same requirements as above, but for `Banana` instances.

### 3. Refactor `Basket`

File: `src/NotRelevant/DTO/Basket.php`

- Replace the `Apple[]` array property with `AppleCollection`
- Replace the `Banana[]` array property with `BananaCollection`
- Update the constructor accordingly
