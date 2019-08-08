<?php

namespace p810\Dot\Test;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Notice;

use function array_values;
use function p810\Dot\{find, getKeysFromString};

class FunctionsTest extends TestCase
{
    public function testCorrectKeysReturnedFromString()
    {
        $this->assertEquals(['foo', 'bar'], getKeysFromString('foo.bar'));
    }

    public function testNumericKeysAreConvertedToInts()
    {
        $this->assertEquals(['foo', 1, 'bar'], getKeysFromString('foo.1.bar'));
    }

    public function testMultipleDotsDoNotAffectResult()
    {
        // TestCase::assertEquals() would return false because the list returned
        // from array_filter() maintains the original's keys, i.e. the comparison
        // expects [0 => 'foo' (...)] but gets [2 => 'foo' (...)] -- so we use
        // array_values() to make them match
        $keys = array_values(getKeysFromString('..foo.bar...baz.'));
        
        $this->assertEquals(['foo', 'bar', 'baz'], $keys);
    }

    public function testFindReturnsHelloWorld()
    {
        $this->assertEquals('Hello world!', find('foo.bar', [
            'foo' => [
                'bar' => 'Hello world!'
            ]
        ]));
    }

    public function testFindReturnsHelloWorldNumeric()
    {
        $this->assertEquals('Hello world!', find('foo.bar.0', [
            'foo' => [
                'bar' => [
                    'Hello world!'
                ]
            ]
        ]));
    }

    public function testFindIssuesNoticeWhenHaystackIsEmpty()
    {
        $this->expectException(Notice::class);
        $this->assertNull(find('foo.bar', []));
    }

    public function testFindIssuesNoticeWhenIndexDoesNotExist()
    {
        $this->expectException(Notice::class);
        $this->assertNull(find('foo.bam', [
            'foo' => [
                'bar' => 'Hello world!'
            ]
        ]));
    }
}
