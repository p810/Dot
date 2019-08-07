# Dot
> A utility for traversing arrays using dot notation

## Installation
```
$ composer require p810/Dot
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
#### `p810\Dot\find(string $needle, array|\ArrayAccess $haystack): mixed`
> Returns a value from an array using dot notation

<details>
<summary>Arguments</summary>

| Argument | Type | Default | Description |
|----------|------|---------|-------------|
| `$needle` | `string` | n/a | A dot separated list of keys |
| `$haystack` | `array|\ArrayAccess` | n/a | An array or object implementing `\ArrayAccess` |
</details>

<details>
<summary>Exceptions</summary>

| Exception | Reason |
|-----------|--------|
| `\TypeError` | Thrown when the given `$haystack` is not an array or object implementing `\ArrayAccess` |
| `\OutOfBoundsException` | Thrown when an invalid key is encountered |
</details>

> :bulb: `p810\Dot\search()` is an alias for this function, which is itself a wrapper for `p810\Dot\Searcher::getValue()`

## License
This package is released under the [MIT License](https://github.com/p810/Dot/blob/master/LICENSE).
