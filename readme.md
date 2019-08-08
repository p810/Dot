# Dot
> A utility for traversing arrays using dot notation

## Installation
```
$ composer require p810/dot
```

## Example usage
```php
<?php

p810\Dot\find('foo.bar', [
    'foo' => [
        'bar' => 'Hello world!'
    ]
]);
#=> string(12) "Hello world!"
```

## API
#### `p810\Dot\find(string $needle, array $haystack): mixed`
Searches an array for a value based on a dot notated string of keys

| Argument    | Type     | Default | Description                  |
|-------------|----------|---------|------------------------------|
| `$needle`   | `string` | n/a     | A dot separated list of keys |
| `$haystack` | `array`  | n/a     | The array to traverse        |

> :bulb: `p810\Dot\search()` is an alias for this function

#### `p810\Dot\getKeysFromString(string $keys): array<int,string|int>`
Returns a list of keys from a dot notated string

| Argument | Type     | Default | Description                  |
|----------|----------|---------|------------------------------|
| `$keys`  | `string` | n/a     | A dot separated list of keys |

## License
This package is released under the [MIT License](https://github.com/p810/Dot/blob/master/LICENSE).
