<?php

namespace Aviator\Values;

use Aviator\Values\Interfaces\Parser;
use Aviator\Values\Parsers\Parser as DefaultParser;

class PrefixedNumber
{
    /** @var int */
    private $number;

    /** @var string */
    private $prefix;

    /** @var int */
    private $padding;

    public function __construct (int $number, string $prefix, int $padding = 0)
    {
        $this->number = $number;
        $this->prefix = $prefix;
        $this->padding = $padding;
    }

    /**
     * @param string $string
     * @param \Aviator\Values\Interfaces\Parser|null $parser
     * @return \Aviator\Values\PrefixedNumber
     */
    public static function parse (string $string, Parser $parser = null): PrefixedNumber
    {
        [$prefix, $number] = $parser
            ? $parser($string)
            : self::defaultParser()($string);

        return new self(
            (int) $number,
            $prefix,
            strlen($number)
        );
    }

    public function value (): string
    {
        return $this->prefix . $this->padded();
    }

    public function __toString (): string
    {
        return $this->value();
    }

    public function increment (int $by = 1): PrefixedNumber
    {
        return new self(
            $this->number + abs($by),
            $this->prefix,
            $this->padding
        );
    }

    public function decrement (int $by = 1): PrefixedNumber
    {
        return new self(
            max(1, $this->number - abs($by)),
            $this->prefix,
            $this->padding
        );
    }

    public function reset (): PrefixedNumber
    {
        return new self(
            1,
            $this->prefix,
            $this->padding
        );
    }

    private function padded (): string
    {
        return str_pad(
            $this->number,
            $this->padding,
            '0',
            STR_PAD_LEFT
        );
    }

    private static function defaultParser (): Parser
    {
        return new DefaultParser();
    }
}
