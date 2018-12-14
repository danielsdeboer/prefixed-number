<?php

namespace Aviator\Values\Exceptions;

final class NotAPrefixedNumber extends \Exception
{
    const FORMAT = 'Your string "%s" is not a prefixed number';

    public static function of (string $string): array
    {
        throw new self(
            sprintf(self::FORMAT, $string)
        );
    }
}
