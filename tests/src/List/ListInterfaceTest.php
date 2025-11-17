<?php

namespace Tests\List;

use Tests\TestCase;
use Collection\List\Type;
use Collection\List\Entry;
use Collection\List\ArrayList;
use Collection\List\LinkedList;
use Collection\List\ListFactory;
use Collection\List\Contract\ListInterface;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(LinkedList::class)]
#[CoversClass(ArrayList::class)]
#[UsesClass(ListFactory::class)]
#[UsesClass(Entry::class)]
class ListInterfaceTest extends TestCase
{
    public static function objectProvider(): array
    {
        $listFactory = new ListFactory();

        return [
            [$listFactory->make(Type::LinkedList)],
            [$listFactory->make(Type::ArrayList)],
        ];
    }

    public static function multiObjectProvider(): array
    {
        $listFactory = new ListFactory();

        return [
            [$listFactory->make(Type::LinkedList), $listFactory->make(Type::LinkedList)],
            [$listFactory->make(Type::ArrayList), $listFactory->make(Type::ArrayList)]
        ];
    }

    #[DataProvider('objectProvider')]
    public function testIsEmpty(ListInterface $list): void
    {
        $this->assertTrue($list->isEmpty());

        $list->add(1);

        $this->assertFalse($list->isEmpty());
    }

    #[DataProvider('objectProvider')]
    public function testCount(ListInterface $list): void
    {
        $this->assertEquals(0, $list->count());

        $list->remove(1);
        $this->assertEquals(0, $list->count());

        $list->add(1);
        $list->add(2);
        $list->add(3);

        $this->assertEquals(3, $list->count());

        $list->remove(2);
        $this->assertEquals(2, $list->count());

        $list->remove(3);
        $this->assertEquals(1, $list->count());

        $list->remove(1);
        $this->assertEquals(0, $list->count());
    }

    #[DataProvider('objectProvider')]
    public function testRemove(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $this->assertEquals([1, 2, 3], $list->toArray());

        $list->remove(2);
        $this->assertEquals([1, 3], $list->toArray());

        $list->remove(3);
        $this->assertEquals([1], $list->toArray());

        $list->remove(1);
        $this->assertEquals([], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testContains(ListInterface $list): void
    {
        $this->assertFalse($list->contains(1));

        $list->add(1);
        $list->add(2);
        $list->add(3);

        $this->assertTrue($list->contains(1));
        $this->assertTrue($list->contains(2));
        $this->assertTrue($list->contains(3));

        $this->assertFalse($list->contains(4));
    }

    #[DataProvider('objectProvider')]
    public function testTransform(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $list->transform(function(int $value): int {
            return $value * $value;
        });

        $this->assertEquals([1, 4, 9], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testFilter(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);
        $list->add(4);

        $list->filter(function(int $value): int {
            return 0 === ($value % 2);
        });

        $this->assertEquals(2, $list->count());
        $this->assertEquals([2, 4], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testClear(ListInterface $list): void
    {
        $list->add(1);
        $list->clear();

        $this->assertTrue($list->isEmpty());
        $this->assertEquals(0, $list->count());
        $this->assertEquals([], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testAddFirst(ListInterface $list): void
    {
        $list->addFirst(1);
        $list->addFirst(2);

        $this->assertEquals(2, $list->count());
        $this->assertEquals([2, 1], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testAddLast(ListInterface $list): void
    {
        $list->addLast(1);
        $list->addLast(2);

        $this->assertEquals(2, $list->count());
        $this->assertEquals([1, 2], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testRemoveFirst(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $list->removeFirst();

        $this->assertEquals(2, $list->count());
        $this->assertEquals([2, 3], $list->toArray());
    }

    #[DataProvider('objectProvider')]
    public function testRemoveLast(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $list->removeLast();

        $this->assertEquals(2, $list->count());
        $this->assertEquals([1, 2], $list->toArray());
    }

    #[DataProvider('multiObjectProvider')]
    public function testAddAll(ListInterface $listOne, ListInterface $listTwo): void
    {
        $listOne->add(1);
        $listOne->add(2);
        $listOne->add(3);

        $listTwo->add(4);
        $listTwo->add(5);
        $listTwo->add(6);

        $listOne->addAll($listTwo);

        $this->assertEquals(6, $listOne->count());
        $this->assertEquals([1, 2, 3, 4, 5, 6], $listOne->toArray());
    }

}
