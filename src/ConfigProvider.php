<?php

declare(strict_types=1);

namespace MicroPHP\Swagger;

use MicroPHP\Framework\Config\ConfigProviderInterface;

class ConfigProvider implements ConfigProviderInterface
{
    public function config(): array
    {
        return [
            'publish' => [
                'swoole' => [
                    'from' => __DIR__ . '/config.php',
                    'to' => base_path('config/swagger.php'),
                ],
            ],
        ];
    }
}
