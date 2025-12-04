<?php

namespace Tests\List;

use Tests\TestCase;
use SK\Collection\List\Entry;
use SK\Collection\List\ArrayList;
use SK\Collection\List\LinkedList;
use SK\Collection\List\ArrayListFactory;
use SK\Collection\List\LinkedListFactory;
use PHPUnit\Framework\Attributes\UsesClass;
use SK\Collection\List\Interface\ListInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use SK\Collection\List\Exception\IndexOutOfBoundsException;

#[CoversClass(LinkedList::class)]
#[CoversClass(ArrayList::class)]
#[UsesClass(LinkedListFactory::class)]
#[UsesClass(ArrayListFactory::class)]
#[UsesClass(Entry::class)]
class ListInterfaceTest extends TestCase
{
    public static function objectProvider(): array
    {
        return [
            [(new LinkedListFactory())->createInstance()],
            [(new LinkedListFactory())->createInstance()],
        ];
    }

    public static function multiObjectProvider(): array
    {
        return [
            [(new LinkedListFactory())->createInstance(), (new LinkedListFactory())->createInstance()],
            [(new ArrayListFactory())->createInstance(), (new ArrayListFactory())->createInstance()]
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
        $this->assertEmpty($list->toArray());
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

    #[DataProvider('objectProvider')]
    public function testGet(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $value = $list->get(0);
        $this->assertEquals(1, $value);

        $value = $list->get(2);
        $this->assertEquals(3, $value);

        $value = $list->get(1);
        $this->assertEquals(2, $value);

        $this->expectException(IndexOutOfBoundsException::class);
        $list->get(3);
    }

    #[DataProvider('objectProvider')]
    public function testIndexOf(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $this->assertEquals(0, $list->indexOf(1));

        $this->assertEquals(1, $list->indexOf(2));

        $this->assertEquals(2, $list->indexOf(3));

        $this->assertEquals(-1, $list->indexOf(4));
    }

    #[DataProvider('objectProvider')]
    public function testLastIndexOf(ListInterface $list): void
    {
        $list->add(1);
        $list->add(1);
        $list->add(2);
        $list->add(2);
        $list->add(3);
        $list->add(3);

        $this->assertEquals(0, $list->indexOf(1));
        $this->assertEquals(1, $list->lastIndexOf(1));

        $this->assertEquals(2, $list->indexOf(2));
        $this->assertEquals(3, $list->lastIndexOf(2));

        $this->assertEquals(4, $list->indexOf(3));
        $this->assertEquals(5, $list->lastIndexOf(3));

        $this->assertEquals(-1, $list->lastIndexOf(4));
    }

    #[DataProvider('objectProvider')]
    public function testSet(ListInterface $list): void
    {
        $list->add(4);
        $list->add(5);
        $list->add(6);

        $list->set(0, 1);
        $list->set(1, 2);
        $list->set(2, 3);

        $this->assertEquals([1, 2, 3], $list->toArray());

        $this->expectException(IndexOutOfBoundsException::class);
        $list->set(3, 4);
    }

    #[DataProvider('objectProvider')]
    public function testUnset(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $list->unset(1);
        $this->assertEquals([1, 3], $list->toArray());

        $list->unset(0);
        $this->assertEquals([3], $list->toArray());

        $list->unset(0);
        $this->assertEmpty($list->toArray());

        $this->expectException(IndexOutOfBoundsException::class);
        $list->unset(0);
    }

    #[DataProvider('objectProvider')]
    public function testSerialization(ListInterface $list): void
    {
        $list->add(1);
        $list->add(2);
        $list->add(3);

        $list = unserialize(serialize($list));

        $this->assertEquals([1, 2, 3], $list->toArray());
    }

}
