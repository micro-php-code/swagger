<?php

declare(strict_types=1);

namespace MicroPHP\Swagger\Util;

use MicroPHP\Swagger\Schema\Property;
use ReflectionClass;

class AttributeCollect
{
    protected ReflectionClass $reflection;

    /**
     * @var class-string
     */
    private string $class;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public static function make(string $class): static
    {
        return new static($class);
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        $properties = [];
        foreach ($this->getReflection()->getProperties() as $property) {
            $reflectionAttributes = $property->getAttributes(Property::class);
            if (empty($reflectionAttributes)) {
                $reflectionAttributes = $property->getAttributes(\OpenApi\Annotations\Property::class);
            }
            foreach ($reflectionAttributes as $attribute) {
                $arguments = $attribute->getArguments();
                $arguments['property'] = $property->getName();
                $arguments['type'] = $property->getType()->getName();
                $properties[] = new Property(...$arguments);
            }
        }

        return $properties;
    }

    public function getNotHaveDefaultValuePropertyNames(): array
    {
        $required = [];
        foreach ($this->getReflection()->getProperties() as $property) {
            if (! $property->hasDefaultValue() && ($property->getAttributes(Property::class) || $property->getAttributes(\OpenApi\Annotations\Property::class))) {
                $required[] = $property->getName();
            }
        }

        return $required;
    }

    /**
     * @throws
     */
    protected function getReflection(): ReflectionClass
    {
        if (! isset($this->reflection)) {
            $this->reflection = new ReflectionClass($this->class);
        }

        return $this->reflection;
    }
}
