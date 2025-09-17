<?php

declare(strict_types=1);

namespace Cndrsdrmn\Typed\Concerns;

/**
 * @internal
 *
 * @template TTypedValue of array<array-key, mixed>
 */
trait ValidatesAttributes
{
    /**
     * Validate the value of the given key is an array.
     *
     * @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return static<TTypedValue & array<TKey, array<array-key, mixed>>>
     */
    public function isArray(array|int|string $key, mixed $default = null): static
    {
        return $this->validate(
            context: 'array',
            validator: fn ($value) => is_array($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a boolean.
     *
     * @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return static<TTypedValue & array<TKey, bool>>
     */
    public function isBoolean(array|int|string $key, mixed $default = null): static
    {
        return $this->validate(
            context: 'boolean',
            validator: fn ($value) => is_bool($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a float.
     *
     * @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return static<TTypedValue & array<TKey, float>>
     */
    public function isFloat(array|int|string $key, mixed $default = null): static
    {
        return $this->validate(
            context: 'float',
            validator: fn ($value) => is_float($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is an integer.
     *
     * @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return static<TTypedValue & array<TKey, int>>
     */
    public function isInteger(array|int|string $key, mixed $default = null): static
    {
        return $this->validate(
            context: 'integer',
            validator: fn ($value) => is_int($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a list.
     *
     * @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return static<TTypedValue & array<TKey, list<mixed>>>
     */
    public function isList(array|int|string $key, mixed $default = null): static
    {
        return $this->validate(
            context: 'list',
            validator: fn ($value) => is_array($value) && array_is_list($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a string.
     *
     * @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return static<TTypedValue & array<TKey, string>>
     */
    public function isString(array|int|string $key, mixed $default = null): static
    {
        return $this->validate(
            context: 'string',
            validator: fn ($value) => is_string($value),
            keys: $key,
            default: $default,
        );
    }
}
