<?php

namespace p810\Dot\Test;

use TypeError;
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
}
