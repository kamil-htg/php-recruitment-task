<?php

declare(strict_types=1);

namespace App\NotRelevant\DTO;

final readonly class Basket
{
    public function __construct(
        public string $label,
        /** @var Apple[] */
        public array $apples,
        /** @var Banana[] */
        public array $bananas,
    ) {
    }
}
