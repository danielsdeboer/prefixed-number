<?php

namespace Aviator\Values\Interfaces;

interface Parser
{
    public function __invoke (string $string): array;
}
