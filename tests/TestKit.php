<?php

declare(strict_types=1);

namespace Sunrise\Coder\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;
use Sunrise\Coder\MediaTypeInterface;

use function is_int;

/**
 * @psalm-require-extends TestCase
 * @phpstan-require-extends TestCase
 */
trait TestKit
{
    protected function mockMediaType(
        string $identifier,
        int|InvocationOrder|null $calls = null,
    ): MediaTypeInterface&MockObject {
        $mediaType = $this->createMock(MediaTypeInterface::class);
        $mediaType->expects(self::normalizeInvocationOrder($calls))->method('getIdentifier')->willReturn($identifier);
        return $mediaType;
    }

    private static function normalizeInvocationOrder(
        null|bool|int|InvocationOrder $invocationOrder,
    ): InvocationOrder {
        if ($invocationOrder === null) {
            return self::any();
        }
        if ($invocationOrder === false || $invocationOrder === 0) {
            return self::never();
        }
        if ($invocationOrder === true || $invocationOrder === 1) {
            return self::once();
        }
        if (is_int($invocationOrder)) {
            return self::exactly($invocationOrder);
        }

        return $invocationOrder;
    }
}
