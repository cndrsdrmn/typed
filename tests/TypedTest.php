<?php

declare(strict_types=1);

namespace Tests;

use Cndrsdrmn\Typed\Typed;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TypedTest extends TestCase
{
    #[Test]
    public function it_validates_array_values_correctly(): void
    {
        $typed = Typed::of(['key1' => [1, 2, 3], 'key2' => ['a', 'b', 'c']]);

        $typed->isArray(['key1', 'key2']);

        $this->assertTrue(true);
    }

    #[Test]
    public function it_validates_nested_array_values_using_dot_correctly(): void
    {
        $typed = Typed::of(['key1' => ['key2' => ['a', 'b', 'c']]]);

        $typed->isArray('key1.key2');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_exception_for_non_array_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1' must be a 'array'.");

        $typed = Typed::of(['key1' => 'not an array']);

        $typed->isArray('key1');
    }

    #[Test]
    public function it_throws_exception_for_non_nested_array_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1.key2' must be a 'array'.");

        $typed = Typed::of(['key1' => ['key2' => 'not an array']]);

        $typed->isArray('key1.key2');
    }

    #[Test]
    public function it_validates_list_values_correctly(): void
    {
        $typed = Typed::of(['key1' => [1, 2, 3], 'key2' => ['a', 'b', 'c']]);

        $typed->isList(['key1', 'key2']);

        $this->assertTrue(true);
    }

    #[Test]
    public function it_validates_nested_list_values_using_dot_correctly(): void
    {
        $typed = Typed::of(['key1' => ['key2' => [1, 2, 3]]]);

        $typed->isList('key1.key2');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_exception_for_non_list_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1' must be a 'list'.");

        $typed = Typed::of(['key1' => 'not a list']);

        $typed->isList('key1');
    }

    #[Test]
    public function it_throws_exception_for_nested_non_list_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1.key2' must be a 'list'.");

        $typed = Typed::of(['key1' => ['key2' => 'not a list']]);

        $typed->isList('key1.key2');
    }

    #[Test]
    public function it_validates_string_values_correctly(): void
    {
        $typed = Typed::of(['key1' => 'value1', 'key2' => 'value2']);

        $typed->isString(['key1', 'key2']);

        $this->assertTrue(true);
    }

    #[Test]
    public function it_validates_nested_string_values_using_dot_correctly(): void
    {
        $typed = Typed::of(['key1' => ['key2' => 'value2']]);

        $typed->isString('key1.key2');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_exception_for_non_string_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1' must be a 'string'.");

        $typed = Typed::of(['key1' => 123]);

        $typed->isString('key1');
    }

    #[Test]
    public function it_throws_exception_for_nested_non_string_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1.key2' must be a 'string'.");

        $typed = Typed::of(['key1' => ['key2' => 123]]);

        $typed->isString('key1.key2');
    }

    #[Test]
    public function it_validates_int_values_correctly(): void
    {
        $typed = Typed::of(['key1' => 123, 'key2' => 456]);

        $typed->isInteger(['key1', 'key2']);

        $this->assertTrue(true);
    }

    #[Test]
    public function it_validates_nested_int_values_using_dot_correctly(): void
    {
        $typed = Typed::of(['key1' => ['key2' => 123]]);

        $typed->isInteger('key1.key2');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_exception_for_non_int_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1' must be a 'integer'.");

        $typed = Typed::of(['key1' => '123']);

        $typed->isInteger('key1');
    }

    #[Test]
    public function it_throws_exception_for_nested_non_int_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1.key2' must be a 'integer'.");

        $typed = Typed::of(['key1' => ['key2' => '123']]);

        $typed->isInteger('key1.key2');
    }

    #[Test]
    public function it_validates_float_values_correctly(): void
    {
        $typed = Typed::of(['key1' => 123.45, 'key2' => 678.90]);

        $typed->isFloat(['key1', 'key2']);

        $this->assertTrue(true);
    }

    #[Test]
    public function it_validates_nested_float_values_using_dot_correctly(): void
    {
        $typed = Typed::of(['key1' => ['key2' => 123.45]]);

        $typed->isFloat('key1.key2');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_exception_for_non_float_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1' must be a 'float'.");

        $typed = Typed::of(['key1' => '123.45']);

        $typed->isFloat('key1');
    }

    #[Test]
    public function it_throws_exception_for_nested_non_float_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1.key2' must be a 'float'.");

        $typed = Typed::of(['key1' => ['key2' => '123.45']]);

        $typed->isFloat('key1.key2');
    }

    #[Test]
    public function it_validates_bool_values_correctly(): void
    {
        $typed = Typed::of(['key1' => true, 'key2' => false]);

        $typed->isBoolean(['key1', 'key2']);

        $this->assertTrue(true);
    }

    #[Test]
    public function it_validates_nested_bool_values_using_dot_correctly(): void
    {
        $typed = Typed::of(['key1' => ['key2' => true]]);

        $typed->isBoolean('key1.key2');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_exception_for_non_bool_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1' must be a 'boolean'.");

        $typed = Typed::of(['key1' => 'true']);

        $typed->isBoolean('key1');
    }

    #[Test]
    public function it_throws_exception_for_nested_non_bool_values(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The value of key 'key1.key2' must be a 'boolean'.");

        $typed = Typed::of(['key1' => ['key2' => 'true']]);

        $typed->isBoolean('key1.key2');
    }
}
