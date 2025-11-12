<?php

namespace Collection\List;

use Traversable;
use ArrayIterator;
use Collection\List\AbstractList;

class ArrayList extends AbstractList {

    protected array $data = [];

    public function insert(mixed $value): void
    {
        $this->data[] = $value;

        $this->count++;
    }

    public function delete(mixed $value): void
    {
        $index = array_search($value, $this->data, true);

        if (false !== $index) {
            $this->data = array_merge(
                    array_slice($this->data, 0, $index),
                    array_slice($this->data, $index + 1, $this->count)
                );

            $this->count--;
        }
    }

    public function contains(mixed $value): bool
    {
        return in_array($value, $this->data, true);
    }

    public function getIterator(): Traversable
    {
        return (function () {
            foreach ($this->data as $key => $value) {
                yield $key => $value;
            }
        })();
    }

}

