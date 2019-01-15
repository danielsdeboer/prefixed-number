<?php

namespace Tests;

use Aviator\Values\Exceptions\NotAPrefixedNumber;
use Aviator\Values\PrefixedNumber;
use PHPUnit\Framework\TestCase;
use Tests\Fixtures\TestParser;

class PrefixedNumberTest extends TestCase
{
    /** @test */
    public function instantiating ()
    {
        $vo = new PrefixedNumber(1, 'PRE', 2);

        $this->assertSame('PRE01', $vo->value());
    }

    /** @test */
    public function parsing_with_static_constructor ()
    {
        $str = 'PRE00120';
        $vo = PrefixedNumber::parse($str);

        $this->assertSame($str, $vo->value());
    }

    /** @test */
    public function trying_to_parse_an_invalid_string ()
    {
        $this->expectException(NotAPrefixedNumber::class);

        PrefixedNumber::parse('00PRE120');
    }

    /** @test */
    public function incrementing ()
    {
        $str = 'S00100';

        $original = PrefixedNumber::parse($str);
        $incremented = $original->increment();

        $this->assertNotSame($original, $incremented);
        $this->assertSame('S00101', $incremented->value());
    }

    /** @test */
    public function decrementing ()
    {
        $str = 'S00100';

        $original = PrefixedNumber::parse($str);
        $decremented = $original->decrement();

        $this->assertNotSame($original, $decremented);
        $this->assertSame('S00099', $decremented->value());
    }

    /** @test */
    public function resetting_to_1 ()
    {
        $number = new PrefixedNumber(22, 'PRE', 3);
        $reset = $number->reset();

        $this->assertSame('PRE022', $number->value());
        $this->assertSame('PRE001', $reset->value());
    }

    public function trying_to_decrement_below_one ()
    {
        $str = 'S01';

        $original = PrefixedNumber::parse($str);
        $decremented = $original->decrement(1);

        $this->assertNotSame($original, $decremented);
        $this->assertSame('S01', $decremented->value());
    }

    /** @test */
    public function trying_to_increment_with_a_negative_number ()
    {
        $str = 'NICETRY01';

        $original = PrefixedNumber::parse($str);
        $incremented = $original->increment(-1);

        $this->assertNotSame($original, $incremented);
        $this->assertSame('NICETRY02', $incremented->value());
    }

    /** @test */
    public function trying_to_decrement_with_a_negative_number ()
    {
        $str = 'NICETRY99';

        $original = PrefixedNumber::parse($str);
        $decremented = $original->decrement(-1);

        $this->assertNotSame($original, $decremented);
        $this->assertSame('NICETRY98', $decremented->value());
    }

    /** @test */
    public function using_a_different_parser ()
    {
        $parsed = PrefixedNumber::parse('X99', new TestParser());

        $this->assertSame('test1', $parsed->value());
    }
}
