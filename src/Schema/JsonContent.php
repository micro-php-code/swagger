<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Schema;

use Attribute;
use OpenApi\Attributes\JsonContent as SwaggerJsonContent;
use OpenApi\Attributes\Property;

#[Attribute(Attribute::TARGET_CLASS)]
class JsonContent extends SwaggerJsonContent
{
    public function __construct(bool $isResponse, ?string $ref = null, ?array $properties = null)
    {
        if ($isResponse) {
            $baseProperties = static::getResponseBaseProperties();
            if (! empty($ref)) {
                $baseProperties[] = new Property(
                    property: 'data',
                    ref: $ref,
                    description: '数据',
                    type: 'object'
                );
            } else {
                $baseProperties[] = new Property(
                    property: 'data',
                    description: '数据',
                    properties: $properties,
                    type: 'object',
                );
            }
            parent::__construct(properties: $baseProperties);
        } else {
            parent::__construct(ref: $ref, properties: $properties);
        }
    }

    public static function getResponseBaseProperties(): array
    {
        return [
            new Property(property: 'code', description: 'code', type: 'integer', enum: [200, 400, 500], example: 200),
            new Property(property: 'message', description: 'message', type: 'string', example: '请求成功'),
        ];
    }
}
