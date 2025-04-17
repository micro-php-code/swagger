<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Traits;

use MicroPHP\Swagger\Util\AttributeCollect;

trait GetPropertySchema
{
    public static function getRefProperties(): array
    {
        return (new AttributeCollect(static::class))->getProperties();
    }
}
