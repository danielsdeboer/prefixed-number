<?php

namespace Aviator\Values;

use Aviator\Values\Exceptions\NotAPrefixedNumber;

class PrefixedNumber
{
    /** @var int */
    private $number;

    /** @var string */
    private $prefix;

    /** @var int */
    private $padding;

    public function __construct (int $number, string $prefix, int $padding)
    {
        $this->number = $number;
        $this->prefix = $prefix;
        $this->padding = $padding;
    }

    public static function parse (string $string): PrefixedNumber
    {
        [$prefix, $number] = NotAPrefixedNumber::check($string);

        return new self((int) $number, $prefix, strlen($number));
    }

    public function value (): string
    {
        return $this->prefix . $this->padded();
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

    private function padded (): string
    {
        return str_pad(
            $this->number,
            $this->padding,
            '0',
            STR_PAD_LEFT
        );
    }
}
