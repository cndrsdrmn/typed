<?php

declare(strict_types=1);

namespace Cndrsdrmn\Typed\Concerns;

/**
 * @internal
 */
trait RetrievesTypedAttributes
{
    /**
     * Get the array value of the given key.
     *
     * @template TArrayKey of array-key
     * @template TArrayValue
     *
     * @param  array<TArrayKey, TArrayValue>  $default
     * @return array<TArrayKey, TArrayValue>
     */
    public function array(int|string $key, array $default = []): array
    {
        return $this->verify(
            context: 'array',
            validator: fn ($value): bool => is_array($value),
            key: $key,
            default: $default
        );
    }

    /**
     * Get the boolean value of the given key.
     */
    public function boolean(int|string $key, bool $default = false): bool
    {
        return $this->verify(
            context: 'boolean',
            validator: fn ($value): bool => is_bool($value),
            key: $key,
            default: $default
        );
    }

    /**
     * Get the float value of the given key.
     */
    public function float(int|string $key, float $default = 0.0): float
    {
        return $this->verify(
            context: 'float',
            validator: fn ($value): bool => is_float($value),
            key: $key,
            default: $default
        );
    }

    /**
     * Get the integer value of the given key.
     */
    public function integer(int|string $key, int $default = 0): int
    {
        return $this->verify(
            context: 'integer',
            validator: fn ($value): bool => is_int($value),
            key: $key,
            default: $default
        );
    }

    /**
     * Get the list value of the given key.
     *
     * @template TListItem
     *
     * @param  list<TListItem>  $default
     * @return list<TListItem>
     */
    public function list(int|string $key, array $default = []): array
    {
        return $this->verify(
            context: 'list',
            validator: fn ($value): bool => is_array($value) && array_is_list($value),
            key: $key,
            default: $default
        );
    }

    /**
     * Get the string value of the given key.
     */
    public function string(int|string $key, string $default = ''): string
    {
        return $this->verify(
            context: 'string',
            validator: fn ($value): bool => is_string($value),
            key: $key,
            default: $default
        );
    }
}
