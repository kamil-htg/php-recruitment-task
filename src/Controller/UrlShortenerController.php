<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UrlShortenerController
{
    #[Route('/api/shorten', name: 'api_shorten', methods: ['POST'])]
    public function shorten(Request $request): JsonResponse
    {
        // TODO: Implement URL shortening logic
        return new JsonResponse(['error' => 'Not implemented'], Response::HTTP_NOT_IMPLEMENTED);
    }

    #[Route('/api/evaluate/{shortCode}', name: 'api_evaluate', methods: ['GET'])]
    public function evaluate(string $shortCode): Response
    {
        // TODO: Implement short code evaluation (redirect, 404, or 410)
        return new JsonResponse(['error' => 'Not implemented'], Response::HTTP_NOT_IMPLEMENTED);
    }
}
