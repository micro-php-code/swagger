<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Contract;

use MicroPHP\Swagger\Enum\MethodEnum;

interface PathGetterInterface
{
    public static function getPath(string $controller, string $function, ?MethodEnum $requestMethod = null): ?string;
}
