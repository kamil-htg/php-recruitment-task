<?php

declare(strict_types=1);

namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlShortenerApiTest extends WebTestCase
{
    public function testShortenClaudeUrl(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/shorten', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'url' => 'https://code.claude.com/docs/en/overview',
        ]));

        self::assertResponseStatusCodeSame(201);

        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertArrayHasKey('short_code', $response);
        self::assertArrayHasKey('original_url', $response);
        self::assertArrayHasKey('expires_at', $response);
        self::assertSame('https://code.claude.com/docs/en/overview', $response['original_url']);
        self::assertNotNull($response['expires_at']);
    }

    public function testShortenGoogleAiUrl(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/shorten', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'url' => 'https://ai.google.dev/gemini-api/docs/quickstart',
        ]));

        self::assertResponseStatusCodeSame(201);

        $response = json_decode($client->getResponse()->getContent(), true);

        self::assertArrayHasKey('short_code', $response);
        self::assertArrayHasKey('original_url', $response);
        self::assertArrayHasKey('expires_at', $response);
        self::assertSame('https://ai.google.dev/gemini-api/docs/quickstart', $response['original_url']);
        self::assertNotNull($response['expires_at']);
    }

    public function testShortenUnsupportedUrlIsRejected(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/shorten', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'url' => 'https://example.com/some/path',
        ]));

        self::assertResponseStatusCodeSame(422);
    }

    public function testShortenInvalidUrlIsRejected(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/shorten', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'url' => 'not-a-valid-url',
        ]));

        self::assertResponseStatusCodeSame(422);
    }

    public function testShortenMissingUrlIsRejected(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/shorten', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([]));

        self::assertResponseStatusCodeSame(422);
    }

    public function testEvaluateWithValidShortCode(): void
    {
        $client = static::createClient();

        $client->request('POST', '/api/shorten', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'url' => 'https://code.claude.com/docs/en/overview',
        ]));

        self::assertResponseStatusCodeSame(201);

        $response = json_decode($client->getResponse()->getContent(), true);
        $shortCode = $response['short_code'];

        $client->request('GET', '/api/evaluate/' . $shortCode);

        self::assertResponseRedirects('https://code.claude.com/docs/en/overview');
    }

    public function testEvaluateWithNonExistentShortCodeReturns404(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/evaluate/nonexistent123');

        self::assertResponseStatusCodeSame(404);
    }

    public function testEvaluateWithExpiredUrlReturns410(): void
    {
        self::markTestSkipped(
            'Candidate should implement this test.'
        );
    }
}
