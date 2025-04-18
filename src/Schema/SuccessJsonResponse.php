<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Schema;

use Attribute;
use MicroPHP\Swagger\Contract\CustomPropertyInterface;
use OpenApi\Attributes\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class SuccessJsonResponse extends Response
{
    public function __construct(
        null|object|string $ref = null,
        ?array $headers = null,
        ?array $links = null,
        ?array $x = null,
        ?array $attachables = null,
        string $description = 'success',
        null|int|string $response = 200,
    ) {
        $content = new class($ref) extends JsonContent {
            public function __construct(object|string $ref)
            {
                if ($ref instanceof CustomPropertyInterface) {
                    parent::__construct(isResponse: true, properties: $ref->getProperties());
                } else {
                    parent::__construct(isResponse: true, ref: $ref);
                }
            }
        };
        $ref = null;
        parent::__construct(
            ref: $ref,
            response: $response,
            description: $description,
            headers: $headers,
            content: $content,
            links: $links,
            x: $x,
            attachables: $attachables,
        );
    }
}
