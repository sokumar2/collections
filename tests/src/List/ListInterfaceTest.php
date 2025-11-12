<?php

namespace Tests\List;

use Collection\List\Node;
use Collection\List\ArrayList;
use Collection\List\LinkedList;
use PHPUnit\Framework\TestCase;
use Collection\List\ListFactory;
use Collection\List\Type as ListType;
use Collection\List\Contract\ListInterface;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(LinkedList::class)]
#[CoversClass(ArrayList::class)]
#[UsesClass(ListFactory::class)]
#[UsesClass(Node::class)]
class ListInterfaceTest extends TestCase
{
    public static function objectProvider(): array
    {
        return [
            [(new ListFactory())->make(ListType::LinkedList)],
            [(new ListFactory())->make(ListType::ArrayList)],
        ];
    }

    #[DataProvider('objectProvider')]
    public function testIsEmpty(ListInterface $list): void
    {
        $this->assertTrue($list->isEmpty());

        $list->insert(1);

        $this->assertFalse($list->isEmpty());
    }

    #[DataProvider('objectProvider')]
    public function testCount(ListInterface $list): void
    {
        $this->assertEquals(0, $list->count());

        $list->delete(1);
        $this->assertEquals(0, $list->count());

        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $this->assertEquals(3, $list->count());

        $list->delete(2);
        $this->assertEquals(2, $list->count());

        $list->delete(3);
        $this->assertEquals(1, $list->count());

        $list->delete(1);
        $this->assertEquals(0, $list->count());
    }

    #[DataProvider('objectProvider')]
    public function testDelete(ListInterface $list): void
    {
        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $this->assertEquals([1, 2, 3], $list->toArray());

        $list->delete(2);
        $this->assertEquals([1, 3], $list->toArray());

        $list->delete(3);
        $this->assertEquals([1], $list->toArray());

        $list->delete(1);
        $this->assertEquals([], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testContains(ListInterface $list): void
    {
        $this->assertFalse($list->contains(1));

        $list->insert(1);
        $list->insert(2);
        $list->insert(3);

        $this->assertTrue($list->contains(1));
        $this->assertTrue($list->contains(2));
        $this->assertTrue($list->contains(3));

        $this->assertFalse($list->contains(4));
    }
}
