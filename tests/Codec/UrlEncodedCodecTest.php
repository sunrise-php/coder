<?php

declare(strict_types=1);

namespace Sunrise\Coder\Tests\Codec;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Sunrise\Coder\Codec\UrlEncodedCodec;

use const PHP_QUERY_RFC3986;

final class UrlEncodedCodecTest extends TestCase
{
    public function testSupportedMediaTypes(): void
    {
        $supportedMediaTypeIdentifiers = [];
        foreach ((new UrlEncodedCodec())->getSupportedMediaTypes() as $supportedMediaType) {
            $supportedMediaTypeIdentifiers[] = $supportedMediaType->getIdentifier();
        }

        self::assertSame(['application/x-www-form-urlencoded'], $supportedMediaTypeIdentifiers);
    }

    #[DataProvider('decodeDataProvider')]
    public function testDecode(mixed $expectedData, string $codingData, array $codingContext = [], array $codecContext = []): void
    {
        self::assertSame($expectedData, (new UrlEncodedCodec($codecContext))->decode($codingData, $codingContext));
    }

    #[DataProvider('encodeDataProvider')]
    public function testEncode(string $expectedData, mixed $codingData, array $codingContext = [], array $codecContext = []): void
    {
        self::assertSame($expectedData, (new UrlEncodedCodec($codecContext))->encode($codingData, $codingContext));
    }

    public static function decodeDataProvider(): Generator
    {
        yield [
            ['foo' => 'bar'],
            'foo=bar',
        ];

        yield [
            ['foo' => 'bar', 'bar' => 'baz'],
            'foo=bar&bar=baz',
        ];

        yield [
            ['foo' => 'bar baz'],
            'foo=bar+baz',
        ];

        yield [
            ['foo' => 'bar baz'],
            'foo=bar%20baz',
        ];
    }

    public static function encodeDataProvider(): Generator
    {
        yield [
            'foo=bar',
            ['foo' => 'bar'],
        ];

        yield [
            'foo=bar&bar=baz',
            ['foo' => 'bar', 'bar' => 'baz'],
        ];

        yield [
            'foo=bar+baz',
            ['foo' => 'bar baz'],
        ];

        yield [
            'foo=bar%20baz',
            ['foo' => 'bar baz'],
            [UrlEncodedCodec::CONTEXT_KEY_ENCODING_TYPE => PHP_QUERY_RFC3986],
        ];

        yield [
            'foo=bar%20baz',
            ['foo' => 'bar baz'],
            [],
            [UrlEncodedCodec::CONTEXT_KEY_ENCODING_TYPE => PHP_QUERY_RFC3986],
        ];
    }
}
