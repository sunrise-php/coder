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

namespace Sunrise\Coder;

use Sunrise\Coder\Exception\CodecException;

interface CodecManagerInterface
{
    public function supportsMediaType(MediaTypeInterface ...$mediaTypes): bool;

    /**
     * @param array<array-key, mixed> $context
     *
     * @throws CodecException
     */
    public function decode(MediaTypeInterface $mediaType, string $data, array $context = []): mixed;

    /**
     * @param array<array-key, mixed> $context
     *
     * @throws CodecException
     */
    public function encode(MediaTypeInterface $mediaType, mixed $data, array $context = []): string;
}
