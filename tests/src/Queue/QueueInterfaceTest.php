<?php

namespace Tests\Queue;

use Tests\TestCase;
use Collection\List\Entry;
use Collection\Queue\Queue;
use Collection\Queue\QueueFactory;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Collection\Queue\Interface\QueueInterface;

#[CoversClass(Queue::class)]
#[UsesClass(QueueFactory::class)]
#[UsesClass(Entry::class)]
class QueueInterfaceTest extends TestCase
{
    public static function objectProvider(): array
    {
        return [
            [(new QueueFactory())->createInstance()]
        ];
    }

    #[DataProvider('objectProvider')]
    public function testQueue(QueueInterface $queue): void
    {
        $queue->queue(3);
        $queue->queue(2);
        $queue->queue(1);

        $this->assertEquals(3, $queue->dequeue());
        $this->assertEquals(2, $queue->count());

        $this->assertEquals(2, $queue->dequeue());
        $this->assertEquals(1, $queue->count());

        $this->assertEquals(1, $queue->dequeue());
        $this->assertTrue($queue->isEmpty());
    }

    #[DataProvider('objectProvider')]
    public function testPeek(QueueInterface $queue): void
    {
        $queue->queue(3);
        $queue->queue(2);
        $queue->queue(1);

        $this->assertEquals(3, $queue->peek());
        $this->assertEquals(3, $queue->count());
    }

    #[DataProvider('objectProvider')]
    public function testSerialization(QueueInterface $queue): void
    {
        $queue->queue(3);
        $queue->queue(2);
        $queue->queue(1);
    
        $Queue = unserialize(serialize($queue));

        $this->assertEquals(3, $queue->peek());
        $this->assertEquals(3, $queue->count());
    }
}
