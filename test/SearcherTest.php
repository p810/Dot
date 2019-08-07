<?php

namespace p810\Dot\Test;

use TypeError;
use ArrayAccess;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

use function p810\Dot\find;

class SearcherTest extends TestCase
{
    protected $data = [
        'foo' => [
            'bar' => 'Hello world!'
        ]
    ];

    /**
     * @codeCoverageIgnore
     */
    public function testSearcherRaisesTypeErrorWhenSubjectNotArray()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('p810\Dot\Searcher::getValue() expects an array or object implementing ArrayAccess; NULL given');

        find('', null);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testEmptyArrayRaisesOutOfBoundsException()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('Invalid key: foo');

        find('foo.bar', []);
    }

    /**
     * @codeCoverageIgnore
     */
    public function testInvalidKeyRaisesOutOfBoundsException()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('Invalid key: bam');

        find('foo.bam', $this->data);
    }

    public function testMultipleDotsHaveNoEffect()
    {
        $this->assertEquals('Hello world!', find('foo..bar', $this->data));
        $this->assertEquals('Hello world!', find('.foo.bar.', $this->data));
    }

    public function testSearcherReturnsHelloWorld()
    {
        $this->assertEquals('Hello world!', find('foo.bar', $this->data));
    }

    public function testSearcherRaisesTypeErrorWithObject()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('p810\Dot\Searcher::getValue() expects an array or object implementing ArrayAccess; object given');

        find('foo.bar', new class {});
    }

    public function testSearcherReturnsHelloWorldWithArrayAccessObject()
    {
        $object = new class implements ArrayAccess
        {
            private $data = [
                'foo' => [
                    'bar' => [
                        'bam' => 'Hello world!'
                    ]
                ]
            ];

            public function offsetGet($offset)
            {
                return $this->data[$offset];
            }

            public function offsetSet($offset, $value)
            {
                $this->data[$offset] = $value;
            }

            public function offsetUnset($offset)
            {
                unset($this->data[$offset]);
            }

            public function offsetExists($offset): bool
            {
                return array_key_exists($offset, $this->data);
            }
        };

        $this->assertEquals('Hello world!', find('foo.bar.bam', $object));
    }
}
