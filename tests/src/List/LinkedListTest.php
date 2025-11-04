<?php

namespace Tests\List;

use Collection\List\Node;
use Collection\List\LinkedList;
use PHPUnit\Framework\TestCase;
use Collection\List\LinkedListFactory;
use Collection\List\Contract\ListInterface;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(LinkedList::class)]
#[UsesClass(LinkedListFactory::class)]
#[UsesClass(Node::class)]
class LinkedListTest extends TestCase
{
    protected ListInterface $linkedList;

    public function setUp(): void
    {
        $this->linkedList = (new LinkedListFactory())->getInstance();
    }

    public function testIsEmpty(): void
    {
        $this->assertTrue($this->linkedList->isEmpty());

        $this->linkedList->insert(1);

        $this->assertFalse($this->linkedList->isEmpty());
    }
}
