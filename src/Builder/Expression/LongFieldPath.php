<?php

/**
 * THIS FILE IS AUTO-GENERATED. ANY CHANGES WILL BE LOST!
 */

declare(strict_types=1);

namespace MongoDB\Builder\Expression;

use MongoDB\Builder\Type\FieldPathInterface;

class LongFieldPath implements FieldPathInterface, ResolvesToLong
{
    public readonly string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}