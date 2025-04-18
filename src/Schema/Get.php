<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Schema;

use Attribute;
use MicroPHP\Swagger\Enum\MethodEnum;
use MicroPHP\Swagger\Util\RouteGetter;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\ExternalDocumentation;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Server;
use OpenApi\Generator;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Get extends \OpenApi\Attributes\Get
{
    /**
     * @param Server[]                 $servers
     * @param string[]                 $tags
     * @param Parameter[]              $parameters
     * @param Response[]               $responses
     * @param null|array<string,mixed> $x
     * @param null|Attachable[]        $attachables
     */
    public function __construct(
        ?string $path = null,
        ?string $operationId = null,
        ?string $description = null,
        ?string $summary = null,
        ?array $security = null,
        ?array $servers = null,
        ?RequestBody $requestBody = null,
        ?array $tags = null,
        ?array $parameters = null,
        ?array $responses = null,
        ?array $callbacks = null,
        ?ExternalDocumentation $externalDocs = null,
        ?bool $deprecated = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null
    ) {
        parent::__construct(
            path: $path ?: RouteGetter::getRouteByContent(Generator::$context, MethodEnum::GET),
            operationId: $operationId,
            description: $description,
            summary: $summary,
            security: $security,
            servers: $servers,
            requestBody: $requestBody,
            tags: $tags,
            parameters: $parameters,
            responses: $responses,
            callbacks: $callbacks,
            externalDocs: $externalDocs,
            deprecated: $deprecated,
            x: $x,
            attachables: $attachables
        );
    }
}
