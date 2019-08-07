<?php

namespace p810\Dot;

use TypeError;
use ArrayAccess;
use OutOfBoundsException;

use function gettype;
use function explode;
use function is_array;
use function is_object;
use function array_filter;
use function array_reduce;
use function array_key_exists;

class Searcher
{
    /**
     * Returns a list of keys from the given string
     * 
     * @param string $keys
     * @return string[]
     */
    protected static function getKeysFromString(string $keys): array
    {
        $keys = explode('.', $keys);

        return array_filter($keys, function ($key) {
            return (bool) $key;
        });
    }

    /**
     * Searches an array for the value at the index matching the last key of `$keys`
     * 
     * @param string $keys A dot separated list of keys
     * @param array|\ArrayAccess $data An array or object implementing \ArrayAccess
     * @return mixed
     * @throws \TypeError if the given $data is not an array or object implementing \ArrayAccess
     * @throws \OutOfBoundsException if an invalid key is provided
     */
    public static function getValue(string $keys, $data)
    {
        if (! self::isValidSubject($data)) {
            self::throwTypeError($data);
        }

        $keys = self::getKeysFromString($keys);

        return array_reduce($keys, function ($result, $key) {
            if (! is_array($result) || ! array_key_exists($key, $result)) {
                throw new OutOfBoundsException("Invalid key: $key");
            }
            
            $result = $result[$key];

            return $result;
        }, $data);
    }

    /**
     * Returns a boolean indicating whether the given data is an array or an object
     * implementing \ArrayAccess
     * 
     * @param mixed $data
     * @return bool
     */
    protected static function isValidSubject($data): bool
    {
        return is_array($data) || (is_object($data) && $data instanceof ArrayAccess);
    }

    /**
     * Throws a \TypeError with a message based on the type of the given data
     * 
     * @param mixed $data
     * @return void
     * @throws \TypeError
     */
    protected static function throwTypeError($data): void
    {
        $type = gettype($data);
        $message = "p810\Dot\Searcher::getValue() expects an array or object implementing ArrayAccess; $type given";

        throw new TypeError($message);
    }
}
