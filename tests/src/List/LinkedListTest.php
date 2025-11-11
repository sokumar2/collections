<?php

namespace Tests\List;

use Collection\List\Node;
use Collection\List\LinkedList;
use PHPUnit\Framework\TestCase;
use Collection\List\ListFactory;
use Collection\List\Type as ListType;
use Collection\List\Contract\ListInterface;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LinkedList::class)]
#[UsesClass(ListFactory::class)]
#[UsesClass(Node::class)]
class LinkedListTest extends TestCase
{
    protected ListInterface $linkedList;

    public function setUp(): void
    {
        $this->linkedList = (new ListFactory())->make(ListType::LinkedList);
    }

    public function testIsEmpty(): void
    {
        $this->assertTrue($this->linkedList->isEmpty());

        $this->linkedList->insert(1);

        $this->assertFalse($this->linkedList->isEmpty());
    }

    public function testCount(): void
    {
        $this->assertEquals(0, $this->linkedList->count());

        $this->linkedList->delete(1);
        $this->assertEquals(0, $this->linkedList->count());

        $this->linkedList->insert(1);
        $this->linkedList->insert(2);
        $this->linkedList->insert(3);

        $this->assertEquals(3, $this->linkedList->count());

        $this->linkedList->delete(2);
        $this->assertEquals(2, $this->linkedList->count());

        $this->linkedList->delete(3);
        $this->assertEquals(1, $this->linkedList->count());

        $this->linkedList->delete(1);
        $this->assertEquals(0, $this->linkedList->count());
    }

    public function testDelete(): void
    {
        $this->linkedList->insert(1);
        $this->linkedList->insert(2);
        $this->linkedList->insert(3);

        $this->assertEquals([1, 2, 3], $this->linkedList->toArray());

        $this->linkedList->delete(2);
        $this->assertEquals([1, 3], $this->linkedList->toArray());

        $this->linkedList->delete(3);
        $this->assertEquals([1], $this->linkedList->toArray());

        $this->linkedList->delete(1);
        $this->assertEquals([], $this->linkedList->toArray());
    }

    public function testContains(): void
    {
        $this->assertFalse($this->linkedList->contains(1));

        $this->linkedList->insert(1);
        $this->linkedList->insert(2);
        $this->linkedList->insert(3);

        $this->assertTrue($this->linkedList->contains(1));
        $this->assertTrue($this->linkedList->contains(2));
        $this->assertTrue($this->linkedList->contains(3));

        $this->assertFalse($this->linkedList->contains(4));
    }
}
