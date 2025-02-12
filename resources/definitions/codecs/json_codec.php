<?php

declare(strict_types=1);

use Sunrise\Coder\Codec\JsonCodec;

use function DI\add;
use function DI\create;
use function DI\get;

return [
    'coder.json_codec.context' => [],

    'coder.codecs' => add([
        create(JsonCodec::class)
            ->constructor(
                context: get('coder.json_codec.context'),
            ),
    ]),
];
