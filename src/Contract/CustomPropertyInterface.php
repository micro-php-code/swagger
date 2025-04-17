<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Contract;

use MicroPHP\Swagger\Schema\Property;

interface CustomPropertyInterface
{
    /**
     * @return Property[]
     */
    public function getProperties(): array;
}
