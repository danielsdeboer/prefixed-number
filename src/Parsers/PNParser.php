<?php

namespace Aviator\Values\Parsers;

use Aviator\Values\Exceptions\NotAPrefixedNumber;
use Aviator\Values\Interfaces\IPNParser;

final class PNParser implements IPNParser
{
    /** @var string */
    private $match;

    /** @var string */
    private $split;

    public function __construct (
        string $match = '/^[a-z]+[\d]+$/i',
        string $split = '/(?<=[a-z])(?=[\d])/i'
    )
    {
        $this->match = $match;
        $this->split = $split;
    }

    /**
     * @param string $string
     * @return array
     * @throws \Aviator\Values\Exceptions\NotAPrefixedNumber
     */
    public function parse (string $string): array
    {
        if (preg_match($this->match, $string)) {
            return preg_split($this->split, $string);
        }

        NotAPrefixedNumber::of($string);
    }
}
