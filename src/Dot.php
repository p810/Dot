<?php

namespace p810\Dot;

/**
 * Returns a value from an array using dot notation
 *
 * @param string $needle A dot separated list of keys
 * @param array|\ArrayAccess $haystack An array or object implementing \ArrayAccess
 * @return mixed
 * @throws \TypeError if the given $haystack is not an array or object implementing \ArrayAccess
 * @throws \OutOfBoundsException if an invalid key is provided
 */
function find(string $needle, $haystack)
{
    return Searcher::getValue($needle, $haystack);
}

/**
 * An alias for p810\Dot\find()
 * 
 * @codeCoverageIgnore
 * @param string $needle A dot separated list of keys
 * @param array|\ArrayAccess $haystack An array or object implementing \ArrayAccess
 * @return mixed
 * @throws \TypeError if the given $haystack is not an array or object implementing \ArrayAccess
 * @throws \OutOfBoundsException if an invalid key is provided
 */
function search(string $needle, $haystack)
{
    return find($needle, $haystack);
}
