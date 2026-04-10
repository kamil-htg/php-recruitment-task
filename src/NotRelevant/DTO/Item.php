<?php

declare(strict_types=1);

namespace App\NotRelevant\DTO;

final readonly class Item
{
    public function __construct(
        public string $name,
        public int $quantity,
    ) {
    }
}
