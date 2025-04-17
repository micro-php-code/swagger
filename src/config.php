<?php

declare(strict_types=1);

use MicroPHP\Swagger\Contract\PathGetterInterface;

return [
    'scan' => [
        'app',
    ],
    'output_dir' => BASE_PATH . '/storage/swagger',
    'filename' => 'openapi.json',
    'version' => '3.1.0',
    'path_getter' => PathGetterInterface::class,
];
