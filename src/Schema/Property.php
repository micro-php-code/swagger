<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Schema;

use Attribute;
use MicroPHP\Enum\EnumHelper;
use OpenApi\Annotations as OA;
use OpenApi\Attributes\AdditionalProperties;
use OpenApi\Attributes\Attachable;
use OpenApi\Attributes\Discriminator;
use OpenApi\Attributes\ExternalDocumentation;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Schema;
use OpenApi\Attributes\Xml;
use OpenApi\Generator;
use UnitEnum;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER | Attribute::TARGET_CLASS_CONSTANT | Attribute::IS_REPEATABLE)]
class Property extends \OpenApi\Attributes\Property
{
    /**
     * @param null|class-string|object|string                              $ref
     * @param string[]                                                     $required
     * @param \OpenApi\Attributes\Property[]                               $properties
     * @param null|non-empty-array<string>|string                          $type
     * @param float|int                                                    $maximum
     * @param float|int                                                    $minimum
     * @param null|array<null|bool|float|int|string|UnitEnum>|class-string $enum
     * @param array<OA\Schema|Schema>                                      $allOf
     * @param array<OA\Schema|Schema>                                      $anyOf
     * @param array<OA\Schema|Schema>                                      $oneOf
     * @param null|array<string,mixed>                                     $x
     * @param null|Attachable[]                                            $attachables
     */
    public function __construct(
        ?string $property = null,
        // schema
        null|object|string $ref = null,
        ?string $schema = null,
        ?string $title = null,
        ?string $description = null,
        ?int $maxProperties = null,
        ?int $minProperties = null,
        ?array $required = null,
        ?array $properties = null,
        null|array|string $type = null,
        ?string $format = null,
        ?Items $items = null,
        ?string $collectionFormat = null,
        mixed $default = Generator::UNDEFINED,
        $maximum = null,
        null|bool|float|int $exclusiveMaximum = null,
        $minimum = null,
        null|bool|float|int $exclusiveMinimum = null,
        ?int $maxLength = null,
        ?int $minLength = null,
        ?int $maxItems = null,
        ?int $minItems = null,
        ?bool $uniqueItems = null,
        ?string $pattern = null,
        null|array|string $enum = null,
        ?Discriminator $discriminator = null,
        ?bool $readOnly = null,
        ?bool $writeOnly = null,
        ?Xml $xml = null,
        ?ExternalDocumentation $externalDocs = null,
        mixed $example = Generator::UNDEFINED,
        ?bool $nullable = null,
        ?bool $deprecated = null,
        ?array $allOf = null,
        ?array $anyOf = null,
        ?array $oneOf = null,
        null|AdditionalProperties|bool $additionalProperties = null,
        // annotation
        ?array $x = null,
        ?array $attachables = null,
    ) {
        parent::__construct(
            $property,
            $ref,
            $schema,
            $title,
            $description,
            $maxProperties,
            $minProperties,
            $required,
            $properties,
            $type,
            $format,
            $items,
            $collectionFormat,
            $default,
            $maximum,
            $exclusiveMaximum,
            $minimum,
            $exclusiveMinimum,
            $maxLength,
            $minLength,
            $maxItems,
            $minItems,
            $uniqueItems,
            $pattern,
            $enum,
            $discriminator,
            $readOnly,
            $writeOnly,
            $xml,
            $externalDocs,
            $example,
            $nullable,
            $deprecated,
            $allOf,
            $anyOf,
            $oneOf,
            $additionalProperties,
            $x,
            $attachables,
        );
        $this->setEnum($enum);
    }

    /**
     * @param null|class-string $enumClass
     */
    private function setEnum(?string $enumClass): void
    {
        if (empty($enumClass)) {
            return;
        }
        if (in_array(EnumHelper::class, class_uses($enumClass))) {
            $this->enum = $enumClass::getValues();
            if (empty($this->description)) {
                $this->description = '枚举json';
            }
            $this->description = ((string) $this->description) . ': ' . json_encode($enumClass::getMap(), JSON_UNESCAPED_UNICODE);
        }
    }
}
