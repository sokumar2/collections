<?php

namespace Tests\Queue;

use Tests\TestCase;
use SK\Collection\List\Entry;
use SK\Collection\Queue\Queue;
use SK\Collection\Queue\QueueFactory;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use SK\Collection\Queue\Interface\QueueInterface;

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

        $queue = unserialize(serialize($queue));

        $this->assertEquals(3, $queue->peek());
        $this->assertEquals(3, $queue->count());
    }
}
