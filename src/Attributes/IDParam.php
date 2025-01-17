<?php

declare(strict_types=1);

namespace OpenApiGenerator\Attributes;

use Attribute;

/**
 * Represents a parameter (e.g. /route/{id} where id is the parameter)
 *
 * A schema is automatically set to generate the parameter type
 */
#[Attribute]
class IDParam extends Parameter
{
    public function __construct(
        ?string $description = null,
        string $in = 'path',
        ?bool $required = null,
    ) {
        parent::__construct($description, $in, $required);
    }

    public function setParamType(string $paramType): void
    {
        $this->schema = match ($paramType) {
            'int' => ['type' => 'integer', 'minimum' => 1],
            'bool' => ['type' => 'boolean'],
            'float', 'double' => ['type' => 'number', 'format' => $paramType],
            'mixed' => [],
            default => ['type' => $paramType],
        };
    }
}
