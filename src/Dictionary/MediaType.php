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

namespace Sunrise\Coder\Dictionary;

use Sunrise\Coder\MediaTypeInterface;

enum MediaType: string implements MediaTypeInterface
{
    case JSON = 'application/json';

    public function getIdentifier(): string
    {
        return $this->value;
    }
}
