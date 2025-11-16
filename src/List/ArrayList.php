<?php

namespace Collection\List;

use Traversable;
use ArrayIterator;
use Collection\List\AbstractList;

class ArrayList extends AbstractList {

    protected array $data = [];

    public function add(mixed $value): bool
    {
        $this->data[] = $value;

        $this->count++;

        return true;
    }

    public function remove(mixed $value): bool
    {
        $index = array_search($value, $this->data, true);

        if (false !== $index) {
            $this->data = array_merge(
                    array_slice($this->data, 0, $index),
                    array_slice($this->data, $index + 1, $this->count)
                );

            $this->count--;

            return true;
        }

        return false;
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

    public function transform(callable $callback): self
    {
        foreach ($this->data as $key => $value) {
            $this->data[$key] = call_user_func($callback, $value);
        }

        return $this;
    }

    public function filter(callable $callback): self
    {
        foreach ($this->data as $key => $value) {
            if (!call_user_func($callback, $value)) {
                unset($this->data[$key]);

                $this->count--;
            }
        }

        $this->data = array_values($this->data);

        return $this;
    }

    public function clear(): void
    {
        if (0 < $this->count) {
            $this->data = [];
            $this->count = 0;
        }
    }
}

