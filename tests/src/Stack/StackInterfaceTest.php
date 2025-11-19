<?php

namespace Tests\Stack;

use Tests\TestCase;
use Collection\List\Entry;
use Collection\Stack\Stack;
use Collection\Stack\StackFactory;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Collection\Stack\Interface\StackInterface;

#[CoversClass(Stack::class)]
#[UsesClass(StackFactory::class)]
#[UsesClass(Entry::class)]
class StackInterfaceTest extends TestCase
{
    public static function objectProvider(): array
    {
        return [
            [(new StackFactory())->createInstance()]
        ];
    }

    #[DataProvider('objectProvider')]
    public function testPush(StackInterface $stack): void
    {
        $stack->push(3);
        $stack->push(2);
        $stack->push(1);

        $this->assertEquals(1, $stack->pop());
        $this->assertEquals(2, $stack->count());

        $this->assertEquals(2, $stack->pop());
        $this->assertEquals(1, $stack->count());

        $this->assertEquals(3, $stack->pop());
        $this->assertTrue($stack->isEmpty());
    }

    #[DataProvider('objectProvider')]
    public function testPeek(StackInterface $stack): void
    {
        $stack->push(3);
        $stack->push(2);
        $stack->push(1);

        $this->assertEquals(1, $stack->peek());
        $this->assertEquals(3, $stack->count());
    }

    #[DataProvider('objectProvider')]
    public function testSerialization(StackInterface $stack): void
    {
        $stack->push(3);
        $stack->push(2);
        $stack->push(1);
    
        $stack = unserialize(serialize($stack));

        $this->assertEquals(1, $stack->peek());
        $this->assertEquals(3, $stack->count());
    }
}
