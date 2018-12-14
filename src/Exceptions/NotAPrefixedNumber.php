<?php

namespace Aviator\Values\Exceptions;

class NotAPrefixedNumber extends \Exception
{
    const FORMAT = 'Your string "%s" is not a prefixed number';
    const MATCH = '/^[a-z]+[\d]+$/i';
    const SPLIT = '/(?<=[a-z])(?=[\d])/i';

    public static function check (string $string): array
    {
        if (preg_match(self::MATCH, $string)) {
            return preg_split(self::SPLIT, $string);
        }

        throw new self(sprintf(self::FORMAT, $string));
    }
}
