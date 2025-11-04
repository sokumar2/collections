<?php

namespace Tests\List;

use PHPUnit\Framework\TestCase;
use Collection\List\LinkedListFactory;
use Collection\List\Contract\ListInterface;

class LinkedListTest extends TestCase
{
    protected ListInterface $linkedList;

    public function setUp(): void
    {
        $this->linkedList = new LinkedListFactory()->getInstance();
    }

    public function testIsEmpty(): void
    {
        $this->assertTrue($this->linkedList->isEmpty());

        $this->linkedList->insert(1);

        $this->assertFalse($this->linkedList->isEmpty());
    }
}
