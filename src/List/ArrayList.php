<?php

namespace Collection\List;

use Traversable;
use Collection\List\AbstractList;
use Collection\List\Contract\ListInterface;

class ArrayList extends AbstractList {

    protected array $data = [];

    public function add(mixed $value): bool
    {
        $this->addLast($value);

        return true;
    }

    public function addFirst(mixed $value): void
    {
        array_unshift($this->data, $value);

        $this->count++;
    }

    public function addLast(mixed $value): void
    {
        $this->data[] = $value;

        $this->count++;
    }

    public function addAll(ListInterface $list): bool
    {
        foreach ($list as $value) {
            $this->add($value);
        }

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

    public function removeFirst(): mixed
    {
        $this->count--;

        return array_shift($this->data);
    }

    public function removeLast(): mixed
    {
        $this->count--;

        return array_pop($this->data);
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

