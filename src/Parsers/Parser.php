<?php

namespace Aviator\Values\Parsers;

use Aviator\Values\Exceptions\NotAPrefixedNumber;
use Aviator\Values\Interfaces\Parser as ParserContract;

final class Parser implements ParserContract
{
    /** @var string */
    const MATCH = '/^[a-z]+[\d]+$/i';

    /** @var string */
    const SPLIT = '/(?<=[a-z])(?=[\d])/i';

    /**
     * @param string $string
     * @return array
     * @throws \Aviator\Values\Exceptions\NotAPrefixedNumber
     */
    public function __invoke (string $string): array
    {
        if (preg_match(self::MATCH, $string)) {
            return preg_split(self::SPLIT, $string);
        }

        NotAPrefixedNumber::of($string);
    }
}
