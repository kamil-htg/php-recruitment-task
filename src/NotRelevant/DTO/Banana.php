<?php

declare(strict_types=1);

namespace App\NotRelevant\DTO;

final readonly class Banana
{
    public function __construct(
        public float $lengthCm,
        public bool $ripe,
    ) {
    }
}
