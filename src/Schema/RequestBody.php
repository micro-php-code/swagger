<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Schema;

use Attribute;
use OpenApi\Attributes\Attachable;

#[Attribute(Attribute::TARGET_METHOD)]
class RequestBody extends \OpenApi\Attributes\RequestBody
{
    /**
     * @param null|array<string,mixed> $x
     * @param null|Attachable[]        $attachables
     */
    public function __construct(
        null|object|string $ref = null,
        ?string $request = null,
        ?string $description = null,
        ?bool $required = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null,
    ) {
        $content = new class($ref) extends JsonContent {
            public function __construct(string $ref)
            {
                parent::__construct(isResponse: false, ref: $ref);
            }
        };
        parent::__construct(
            request: $request,
            description: $description,
            required: $required,
            content: $content,
            x: $x,
            attachables: $attachables
        );
    }
}
