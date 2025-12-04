<?php

namespace SK\Collection\List;

use SK\Collection\List\Trait\ArrayableTrait;
use SK\Collection\List\Trait\EmptiableTrait;
use SK\Collection\List\Trait\CountableTrait;
use SK\Collection\List\Interface\ListInterface;
use SK\Collection\List\Exception\IndexOutOfBoundsException;

abstract class AbstractList implements ListInterface
{
    use CountableTrait;
    use EmptiableTrait;
    use ArrayableTrait;

    public function add(mixed $value): bool
    {
        $this->addLast($value);

        return true;
    }

    public function addAll(ListInterface $list): bool
    {
        foreach ($list as $value) {
            $this->add($value);
        }

        return true;
    }

    protected function checkBoundsExclusive(int $index): void
    {
        if ($index < 0 || $index >= $this->count) {
            throw new IndexOutOfBoundsException("Index: " . $index . ", Size:" . $this->count);
        }
    }
}
