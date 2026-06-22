<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'shortened_url')]
class ShortenedUrl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 10, unique: true)]
    private string $shortCode;

    #[ORM\Column(type: Types::STRING, length: 2048)]
    private string $originalUrl;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $expiresAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortCode(): string
    {
        return $this->shortCode;
    }

    public function setShortCode(string $shortCode): void
    {
        $this->shortCode = $shortCode;
    }

    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl(string $originalUrl): void
    {
        $this->originalUrl = $originalUrl;
    }

    public function getExpiresAt(): \DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTimeImmutable $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    public function isExpired(\DateTimeImmutable $now = new \DateTimeImmutable()): bool
    {
        return $this->expiresAt < $now;
    }
}
