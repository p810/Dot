<?php

declare(strict_types=1);

namespace p810\Dot;

use function strlen;
use function explode;
use function array_filter;
use function array_reduce;

/**
 * Searches an array for a value based on a dot notated string of keys
 *
 * @param string $needle
 * @param array  $haystack
 * @return mixed
 */
function find(string $needle, array $haystack)
{
    return array_reduce(getKeysFromString($needle), function ($result, $key) {
        return $result = $result[$key];
    }, $haystack);
}

/**
 * Returns a list of keys from a dot notated string
 *
 * @param string $keys
 * @return array<int,string|int>
 */
function getKeysFromString(string $keys): array
{
    return array_filter(explode('.', $keys), 'strlen');
}

/**
 * An alias for p810\Dot\find()
 * 
 * @codeCoverageIgnore
 * @param string $needle
 * @param array  $haystack
 * @return mixed
 */
function search(string $needle, array $haystack)
{
    return find($needle, $haystack);
}
