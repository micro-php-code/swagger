<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Schema;

use Attribute;
use MicroPHP\Swagger\Util\AttributeCollect;
use OpenApi\Annotations as OA;
use OpenApi\Attributes\AdditionalProperties;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\Discriminator;
use OpenApi\Attributes\Examples;
use OpenApi\Attributes\ExternalDocumentation;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Xml;
use OpenApi\Generator;
use UnitEnum;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Schema extends \OpenApi\Attributes\Schema
{
    /**
     * @param null|class-string|object|string                              $ref
     * @param string[]                                                     $required
     * @param Property[]                                                   $properties
     * @param null|non-empty-array<string>|string                          $type
     * @param float|int                                                    $maximum
     * @param float|int                                                    $minimum
     * @param null|array<null|bool|float|int|string|UnitEnum>|class-string $enum
     * @param array<Examples>                                              $examples
     * @param array<OA\Schema|\OpenApi\Attributes\Schema>                  $allOf
     * @param array<OA\Schema|Schema>                                      $anyOf
     * @param array<OA\Schema|Schema>                                      $oneOf
     * @param null|array<string,mixed>                                     $x
     * @param null|Attachable[]                                            $attachables
     */
    public function __construct(
        // schema
        object|string $ref = null,
        string $schema = null,
        string $title = null,
        string $description = null,
        int $maxProperties = null,
        int $minProperties = null,
        array $required = null,
        array $properties = null,
        array|string $type = null,
        string $format = null,
        Items $items = null,
        string $collectionFormat = null,
        mixed $default = Generator::UNDEFINED,
        $maximum = null,
        bool|float|int $exclusiveMaximum = null,
        $minimum = null,
        bool|float|int $exclusiveMinimum = null,
        int $maxLength = null,
        int $minLength = null,
        int $maxItems = null,
        int $minItems = null,
        bool $uniqueItems = null,
        string $pattern = null,
        array|string $enum = null,
        Discriminator $discriminator = null,
        bool $readOnly = null,
        bool $writeOnly = null,
        Xml $xml = null,
        ExternalDocumentation $externalDocs = null,
        mixed $example = Generator::UNDEFINED,
        array $examples = null,
        bool $nullable = null,
        bool $deprecated = null,
        array $allOf = null,
        array $anyOf = null,
        array $oneOf = null,
        AdditionalProperties|bool $additionalProperties = null,
        mixed $const = Generator::UNDEFINED,
        // annotation
        array $x = null,
        array $attachables = null
    ) {
        parent::__construct(
            ref: $ref,
            schema: $schema,
            title: $title,
            description: $description,
            maxProperties: $maxProperties,
            minProperties: $minProperties,
            required: $required,
            properties: $properties,
            type: $type,
            format: $format,
            items: $items,
            collectionFormat: $collectionFormat,
            default: $default,
            maximum: $maximum,
            exclusiveMaximum: $exclusiveMaximum,
            minimum: $minimum,
            exclusiveMinimum: $exclusiveMinimum,
            maxLength: $maxLength,
            minLength: $minLength,
            maxItems: $maxItems,
            minItems: $minItems,
            uniqueItems: $uniqueItems,
            pattern: $pattern,
            enum: $enum,
            discriminator: $discriminator,
            readOnly: $readOnly,
            writeOnly: $writeOnly,
            xml: $xml,
            externalDocs: $externalDocs,
            example: $example,
            examples: $examples,
            nullable: $nullable,
            deprecated: $deprecated,
            allOf: $allOf,
            anyOf: $anyOf,
            oneOf: $oneOf,
            additionalProperties: $additionalProperties,
            const: $const,
            x: $x,
            attachables: $attachables
        );
        if (is_null($required)) {
            $class = ($this->_context->namespace ?? '') . '\\' . ($this->_context->class ?? '');
            if (class_exists($class)) {
                $this->required = AttributeCollect::make($class)->getNotHaveDefaultValuePropertyNames();
            }
        }
    }
}
