<?php

declare(strict_types=1);

namespace MicroPHP\Swagger;

use MicroPHP\Framework\Config\Config;
use OpenApi\Generator;

class Swagger
{
    public static function gen(): void
    {
        $config = Config::get('swagger', []);
        $generator = new Generator();
        $openapi = $generator->setAliases(Generator::DEFAULT_ALIASES)
            ->setNamespaces(Generator::DEFAULT_NAMESPACES)
            ->setVersion($config['version'] ?? '3.1.0')
            ->generate($config['scan'], validate: true);

        $path = $config['output_dir'];
        @mkdir($path, 0755, true);
        $ext = pathinfo($config['filename'], PATHINFO_EXTENSION);
        file_put_contents(rtrim($path, '/') . '/' . $config['filename'], 'json' == $ext ? $openapi->toJson() : $openapi->toYaml());
    }
}
