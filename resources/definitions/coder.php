<?php

declare(strict_types=1);

use Sunrise\Coder\CodecManager;
use Sunrise\Coder\CodecManagerInterface;

use function DI\create;
use function DI\get;

return [
    'coder.codecs' => [],
    'coder.context' => [],

    CodecManagerInterface::class => create(CodecManager::class)
        ->constructor(
            codecs: get('coder.codecs'),
            context: get('coder.context')
        ),
];
