<?php

namespace Tests\Fixtures;

use Aviator\Values\Interfaces\Parser;

final class TestParser implements Parser
{
    public function __invoke (string $string) : array
    {
        return ['test', 1];
    }
}
