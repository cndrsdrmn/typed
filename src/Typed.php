<?php

declare(strict_types=1);

namespace Cndrsdrmn\Typed;

use Closure;
use InvalidArgumentException;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 */
final readonly class Typed
{
    /** @use Concerns\ValidatesAttributes<TKey, TValue> */
    use Concerns\RetrievesTypedAttributes, Concerns\ValidatesAttributes;

    /**
     * Create a new class instance.
     *
     * @param  array<TKey, TValue>  $values
     */
    public function __construct(private array $values)
    {
        //
    }

    /**
     * Create a new instance from the given data.
     *
     * @template TKeyOf of array-key
     * @template TValueOf
     *
     * @param  array<TKeyOf, TValueOf>  $values
     * @return self<TKeyOf, TValueOf>
     */
    public static function of(array $values): self
    {
        return new self($values);
    }

    /**
     * Get the passed values.
     *
     * @return array<TKey, TValue>
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
     * @template TValidateKey of int|string
     *
     * @param  Closure(mixed): bool  $validator
     * @param  list<TValidateKey>|TValidateKey  $keys
     * @return self<TKey, TValue>
     */
    private function validate(string $context, Closure $validator, array|int|string $keys, mixed $default = null): self
    {
        foreach ((array) $keys as $key) {
            $this->verify($context, $validator, $key, $default);
        }

        return $this;
    }

    /**
     * Verify the value of the given key.
     *
     * @template TVerify
     *
     * @param  Closure(TVerify): bool  $validator
     * @param  TVerify  $default
     * @return TVerify
     *
     * @noinspection PhpDocSignatureInspection
     */
    private function verify(string $context, Closure $validator, int|string $key, mixed $default = null): mixed
    {
        $value = $this->get($key, $default);

        if (! $validator($value)) {
            $this->failure($key, $context);
        }

        return $value;
    }
}
