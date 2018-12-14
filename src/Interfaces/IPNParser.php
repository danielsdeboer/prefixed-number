<?php

namespace Aviator\Values\Interfaces;

interface IPNParser
{
    public function parse (string $string): array;
}
