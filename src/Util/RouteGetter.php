<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Util;

use MicroPHP\Framework\Config\Config;
use MicroPHP\Swagger\Contract\PathGetterInterface;
use MicroPHP\Swagger\Enum\MethodEnum;
use OpenApi\Context;

class RouteGetter
{
    /**
     * @return null|class-string
     */
    public static function getRouteByContent(?Context $context, MethodEnum $requestMethod = null): ?string
    {
        if (! $context) {
            return null;
        }
        $controller = ($context->namespace ?? '') . '\\' . ($context->class ?? '');
        $function = $context->method;
        $class = Config::get('swagger.path_getter');
        if ($class instanceof PathGetterInterface) {
            return $class->getPath($controller, $function, $requestMethod);
        }

        return null;
    }
}
