<?php

declare(strict_types=1);

namespace Cndrsdrmn\Typed;

use Closure;
use InvalidArgumentException;

/**
 * @template TTypedValue of array<array-key, mixed>
 */
final readonly class Typed
{
    /**
     * Create a new class instance.
     *
     * @param  TTypedValue  $values
     */
    public function __construct(private array $values)
    {
        //
    }

    /**
     * Create a new instance from the given data.
     *
     * @template TTypedValueOf of array<array-key, mixed>
     *
     * @param  TTypedValueOf  $values
     * @return self<TTypedValueOf>
     */
    public static function of(array $values): self
    {
        return new self($values);
    }

    /**
     * Validate the value of the given key is an array.
     *
     *  @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return self<TTypedValue>
     */
    public function isArray(array|int|string $key, mixed $default = null): self
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
     *  @template TKey of int|string
     *
     * @param  list<TKey>|TKey  $key
     * @return self<TTypedValue>
     */
    public function isBoolean(array|int|string $key, mixed $default = null): self
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
     * @return self<TTypedValue>
     */
    public function isFloat(array|int|string $key, mixed $default = null): self
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
     * @return self<TTypedValue>
     */
    public function isInteger(array|int|string $key, mixed $default = null): self
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
     * @return self<TTypedValue>
     */
    public function isList(array|int|string $key, mixed $default = null): self
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
     * @return self<TTypedValue>
     */
    public function isString(array|int|string $key, mixed $default = null): self
    {
        return $this->validate(
            context: 'string',
            validator: fn ($value) => is_string($value),
            keys: $key,
            default: $default,
        );
    }

    /**
     * Get the passed values.
     *
     * @return TTypedValue
     */
    public function passed(): array
    {
        return $this->values;
    }

    /**
     * Get the value of a dot-notated key.
     */
    private function dot(mixed $values, string $key, mixed $default = null): mixed
    {
        foreach (explode('.', $key) as $segment) {
            if (is_array($values) && array_key_exists($segment, $values)) {
                $values = $values[$segment];
            } else {
                return $default;
            }
        }

        return $values;
    }

    /**
     * Throw an exception for a failed validation.
     *
     * @throws InvalidArgumentException
     */
    private function failure(int|string $key, string $format): never
    {
        throw new InvalidArgumentException("The value of key '{$key}' must be a '{$format}'.");
    }

    /**
     * Get the value of the given key.
     */
    private function get(int|string $key, mixed $default = null): mixed
    {
        if (is_string($key) && str_contains($key, '.')) {
            return $this->dot($this->values, $key, $default);
        }

        return $this->values[$key] ?? $default;
    }

    /**
     * Validate the method against the given keys.
     *
     * @template TKey of int|string
     *
     * @param  Closure(mixed): bool  $validator
     * @param  list<TKey>|TKey  $keys
     * @return self<TTypedValue>
     *
     * @throws InvalidArgumentException
     */
    private function validate(string $context, Closure $validator, array|int|string $keys, mixed $default = null): self
    {
        foreach ((array) $keys as $key) {
            $value = $this->get($key, $default);

            if (! $validator($value)) {
                $this->failure($key, $context);
            }
        }

        return $this;
    }
}
