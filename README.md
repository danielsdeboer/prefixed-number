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

From there you can get a string representation of the object.

```php
$valueObject->get(); // returns a string representation of the object. 
```

You can also easily increment or decrement it:

```php
$valueObject = PrefixedNumber::parse('X99');

$incremented = $valueObject->increment(); // Returns a new instance of Prefixed Number
$decremented = $valueObject->decrement(); // As does this

echo $incremented->get(); // 'X100'
echo $decremented->get(); // 'X98'
```

## Other

The parser implements `IPNParser`. You can change how this class works by implementing that interface and injecting it as the second parameter of the static parse method:

```php
$valueObject = PrefixedNumber::parse('X99', new MyLittleParser());
```

### License

This package is licensed with the [MIT License (MIT)](LICENSE).

