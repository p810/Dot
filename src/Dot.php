<?php

namespace p810\Dot;

/**
 * Finds a value in a multidimensional array using dot notation.
 *
 * @param string $needle The key to find
 * @param array|object $haystack The array or object to traverse.
 * @throws InvalidArgumentException if $haystack is an object and does not implement ArrayAccess.
 * @throws OutOfBoundsException if $needle resolves to an index that is not defined.
 * @return mixed
 */
function find($needle, $haystack) {
    if (is_object($haystack) && !($haystack instanceof \ArrayAccess)) {
        throw new \InvalidArgumentException('The object supplied does not implement ArrayAccess');
    }

    $levels = explode('.', $needle);
    $value  = $haystack[$levels[0]];

    array_shift($levels);

    foreach ($levels as $index) {
        if (!array_key_exists($index, $value)) {
            throw new \OutOfBoundsException(sprintf('%s is not an index of the current array', $index));
        }

        $value = $value[$index];
    }

    return $value;
}
