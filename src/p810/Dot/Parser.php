<?php

namespace p810\Dot;

class Parser
{
    /**
     * Finds a value in a multidimensional array.
     *
     * @param string $needle The key to find.
     * @param array|object $haystack The array or object to traverse. Objects passed to this method must implement ArrayAccess.
     * @see <http://php.net/manual/en/class.arrayaccess.php>
     * @throws InvalidArgumentException if the value passed in $haystack is an object that does not implement ArrayAccess.
     * @throws InvalidArgumentException if the value passed in $needle doesn't use dot notation.
     * @return mixed
     */
    public static function find($needle, $haystack)
    {
        if (is_object($haystack) && !($haystack instanceof \ArrayAccess)) {
            throw new \InvalidArgumentException('The object supplied does not implement ArrayAccess');
        }

        if (stripos('.', $needle) === false) {
            throw new \InvalidArgumentException('Where\'s the dot?');
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
}
