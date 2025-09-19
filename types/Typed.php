<?php

/** @noinspection PhpExpressionResultUnusedInspection */

declare(strict_types=1);

use Cndrsdrmn\Typed\Typed;

use function PHPStan\Testing\assertType;

// assertType('Cndrsdrmn\Typed\Typed<string, array{nested: string}>', Typed::of(['key' => ['nested' => 'value']]));
assertType('Cndrsdrmn\Typed\Typed<string, bool>', Typed::of(['key' => false]));
assertType('Cndrsdrmn\Typed\Typed<string, float>', Typed::of(['key' => 0.1]));
assertType('Cndrsdrmn\Typed\Typed<string, int>', Typed::of(['key' => 1]));
// assertType('Cndrsdrmn\Typed\Typed<string, list<mixed>>', Typed::of(['key' => [1, 'one', false]]));
assertType('Cndrsdrmn\Typed\Typed<string, string>', Typed::of(['key' => 'value']));
