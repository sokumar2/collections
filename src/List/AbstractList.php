<?php

namespace Collection\List;

use OutOfBoundsException;
use Collection\List\Trait\ArrayableTrait;
use Collection\List\Trait\EmptiableTrait;
use Collection\List\Trait\CountableTrait;
use Collection\List\Contract\ListInterface;

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
            throw new OutOfBoundsException("Index: " . $index . ", Size:" . $this->count);
        }
    }
}
