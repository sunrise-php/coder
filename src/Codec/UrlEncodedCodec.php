<?php

/**
 * It's free open-source software released under the MIT License.
 *
 * @author Anatoly Nekhay <afenric@gmail.com>
 * @copyright Copyright (c) 2025, Anatoly Nekhay
 * @license https://github.com/sunrise-php/coder/blob/master/LICENSE
 * @link https://github.com/sunrise-php/coder
 */

declare(strict_types=1);

namespace Sunrise\Coder\Codec;

use Sunrise\Coder\CodecInterface;
use Sunrise\Coder\Dictionary\MediaType;

use function http_build_query;
use function parse_str;

use const PHP_QUERY_RFC1738;

/**
 * @since 1.1.0
 */
final class UrlEncodedCodec implements CodecInterface
{
    public const CONTEXT_KEY_ENCODING_TYPE = 'url_encoding_type';

    private const DEFAULT_ENCODING_TYPE = PHP_QUERY_RFC1738;

    /**
     * @param array<array-key, mixed> $context
     */
    public function __construct(
        private readonly array $context = [],
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getSupportedMediaTypes(): array
    {
        return [MediaType::UrlEncoded];
    }

    /**
     * @inheritDoc
     */
    public function decode(string $data, array $context = []): mixed
    {
        parse_str($data, $result);

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function encode(mixed $data, array $context = []): string
    {
        $context += $this->context;

        /** @var int $encodingType */
        $encodingType = $context[self::CONTEXT_KEY_ENCODING_TYPE] ?? self::DEFAULT_ENCODING_TYPE;

        return http_build_query((array) $data, '', '&', $encodingType);
    }
}
