<?php

use PHPUnit\Framework\TestCase;
use Src\Queue as QueueAlias;

class QueueTest extends TestCase
{
    protected static $queue;


    public static function setUpBeforeClass(): void
    {
        static::$queue = new QueueAlias();
    }

    protected function setUp(): void
    {
        static::$queue->clear();
    }

    public static function tearDownAfterClass(): void
    {
        static::$queue = null;
    }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, static::$queue->getCount());
    }

    public function testItemIsAddedToQueue()
    {
        static::$queue->push('red');
        $this->assertEquals(1, static::$queue->getCount());
    }

    public function testItemIsRemovedFromQueue()
    {
        static::$queue->push('red');
        $item = static::$queue->pop();
        $this->assertEquals(0, static::$queue->getCount());
        $this->assertEquals('red', $item);
    }

    public function testAnItemIsRemovedFromTheFrontOfTheQueue()
    {
        static::$queue->push('first');
        static::$queue->push('second');
        $this->assertEquals('first', static::$queue->pop());
    }

    public function testMaxNumberOfItemsCanBeAdded()
    {
        for ($i = 0; $i < \Src\Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }

        $this->assertEquals(\Src\Queue::MAX_ITEMS, static::$queue->getCount());
    }

    public function testExceptionThrowWhenAddingAnItemToFullQueue()
    {
        for ($i = 0; $i < \Src\Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Queue is full');

        static::$queue->push('white');
    }

    public function tearDown(): void
    {
    }
}
