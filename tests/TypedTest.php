<?php

declare(strict_types=1);

namespace Tests;

use Cndrsdrmn\Typed\Typed;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TypedTest extends TestCase
{
    public static function values(): array
    {
        return [
            'array' => ['isArray', 'array', ['key' => 'value'], 'value'],
            'boolean' => ['isBoolean', 'boolean', true, 'value'],
            'float' => ['isFloat', 'float', 123.45, 'value'],
            'integer' => ['isInteger', 'integer', 123, 'value'],
            'list' => ['isList', 'list', ['foo', 'bar', 'baz'], 'value'],
            'string' => ['isString', 'string', 'value', 123],
        ];
    }

    #[Test, DataProvider('values')]
    public function it_validates_nested_values_correctly(string $method, string $context, mixed $valid, mixed $invalid): void
    {
        $typed = new Typed(['key' => ['nested' => $valid]]);

        $this->assertInstanceOf(Typed::class, $typed->{$method}('key.nested'));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key.nested' must be a '$context'.");

        $typed = new Typed(['key' => ['nested' => $invalid]]);
        $typed->{$method}('key.nested');
    }

    #[Test, DataProvider('values')]
    public function it_validates_values_correctly(string $method, string $context, mixed $valid, mixed $invalid): void
    {
        $typed = new Typed(['key' => $valid]);

        $this->assertInstanceOf(Typed::class, $typed->{$method}('key'));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key' must be a '$context'.");

        $typed = new Typed(['key' => $invalid]);
        $typed->{$method}('key');
    }
}
