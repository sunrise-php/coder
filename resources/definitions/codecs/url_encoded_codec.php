<?php

declare(strict_types=1);

use Sunrise\Coder\Codec\UrlEncodedCodec;

use function DI\add;
use function DI\create;
use function DI\get;

return [
    'coder.url_encoded_codec.context' => [],

    'coder.codecs' => add([
        create(UrlEncodedCodec::class)
            ->constructor(
                context: get('coder.url_encoded_codec.context'),
            ),
    ]),
];
