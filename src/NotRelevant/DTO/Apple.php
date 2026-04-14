<?php

declare(strict_types=1);

namespace App\NotRelevant\DTO;

final readonly class Apple
{
    public function __construct(
        public string $variety,
        public float $weightGrams,
    ) {
    }
}
