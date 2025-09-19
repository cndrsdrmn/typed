<?php

declare(strict_types=1);

namespace Cndrsdrmn\Typed\Concerns;

/**
 * @internal
 *
 * @template TKey of array-key
 *
 * @template-covariant TValue
 */
trait ValidatesAttributes
{
    /**
     * Validate the value of the given key is an array.
     *
     * @template TValidateKey of int|string
     * @template TValidateValue
     *
     * @param  list<TValidateKey>|TValidateKey  $key
     * @param  array<TValidateKey, TValidateValue>  $default
     * @return self<TKey, TValue & array<TValidateKey, TValidateValue>>
     */
    public function isArray(array|int|string $key, array $default = []): static
    {
        return $this->validate(
            context: 'array',
            validator: fn ($value): bool => is_array($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a boolean.
     *
     * @template TValidateKey of int|string
     *
     * @param  list<TValidateKey>|TValidateKey  $key
     * @return self<TKey, TValue & array<TValidateKey, bool>>
     */
    public function isBoolean(array|int|string $key, bool $default = false): static
    {
        return $this->validate(
            context: 'boolean',
            validator: fn ($value): bool => is_bool($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a float.
     *
     * @template TValidateKey of int|string
     *
     * @param  list<TValidateKey>|TValidateKey  $key
     * @return self<TKey, TValue & array<TValidateKey, float>>
     */
    public function isFloat(array|int|string $key, float $default = 0.0): static
    {
        return $this->validate(
            context: 'float',
            validator: fn ($value): bool => is_float($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is an integer.
     *
     * @template TValidateKey of int|string
     *
     * @param  list<TValidateKey>|TValidateKey  $key
     * @return self<TKey, TValue & array<TValidateKey, int>>
     */
    public function isInteger(array|int|string $key, int $default = 0): static
    {
        return $this->validate(
            context: 'integer',
            validator: fn ($value): bool => is_int($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a list.
     *
     * @template TValidateKey of int|string
     * @template TValidateValue
     *
     * @param  list<TValidateKey>|TValidateKey  $key
     * @param  list<TValidateValue>  $default
     * @return self<TKey, TValue & array<TValidateKey, list<TValidateValue>>>
     */
    public function isList(array|int|string $key, array $default = []): static
    {
        return $this->validate(
            context: 'list',
            validator: fn ($value): bool => is_array($value) && array_is_list($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Validate the value of the given key is a string.
     *
     * @template TValidateKey of int|string
     *
     * @param  list<TValidateKey>|TValidateKey  $key
     * @return self<TKey, TValue & array<TValidateKey, string>>
     */
    public function isString(array|int|string $key, string $default = ''): static
    {
        return $this->validate(
            context: 'string',
            validator: fn ($value): bool => is_string($value),
            keys: $key,
            default: $default,
        );
    }
}
