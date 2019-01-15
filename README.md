## Overview

A simple class to manage prefixed numbers (eg `X99`) without relying on the `intl` extension. 

### Installation

Via Composer:

```
composer require aviator/prefixed-number
```

### Testing

Via Composer:

```
composer test
```

### Usage

Generally, you'll probably want to use `PrefixedNumber::parse($string)`. This will return a new `PrefixedNumber` instance.

You can also instantiate it normally:

```php
$object = new PrefixedNumber($number, $prefix, $padding);
```

From there you can get a string representation of the object.

```php
$object->value(); // returns a string representation of the object. 
```

You can also easily increment or decrement it:

```php
$object = new PrefixedNumber(99, 'X');

$incremented = $object->increment(); // Returns a new instance of PrefixedNumber
$decremented = $object->decrement(); // As does this

echo $object->value(); // 'X99'
echo $incremented->value(); // 'X100'
echo $decremented->value(); // 'X98'
```

You can also reset the number to 1:

```php
$object = new PrefixedNumber(99, 'X');

$reset = $object->reset(); // Returns a new instance

echo $object->value(); // 'X99'
echo $reset->value(); // 'X1'
```

## Other

The parser implements `Aviator\Values\Interfaces\Parser`. You can change how this class works by implementing that interface and injecting it as the second parameter of the static parse method:

```php
$valueObject = PrefixedNumber::parse('X99', new MyLittleParser());
```

### License

This package is licensed with the [MIT License (MIT)](LICENSE).

