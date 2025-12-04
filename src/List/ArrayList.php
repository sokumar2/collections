<?php

namespace SK\Collection\List;

use Traversable;
use SK\Collection\List\AbstractList;

class ArrayList extends AbstractList {

    protected array $data = [];

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

    public function get(int $index): mixed
    {
        $this->checkBoundsExclusive($index);

        return $this->data[$index];
    }

    public function set(int $index, mixed $value): mixed
    {
        $this->checkBoundsExclusive($index);

        $old = $this->data[$index];
        $this->data[$index] = $value;

        return $old;
    }

    public function unset(int $index): mixed
    {
        $this->checkBoundsExclusive($index);

        $value = $this->data[$index];
        unset($this->data[$index]);
        $this->count--;

        $this->data = array_values($this->data);

        return $value;
    }

    public function indexOf(mixed $value): int
    {
        $index = array_search($value, $this->data, true);;

        if (false !== $index) {
            return $index;
        }

        return -1;
    }

    public function lastIndexOf(mixed $value): int
    {
        $indexes = array_keys($this->data, $value, true);

        if (!empty($indexes)) {
            return array_pop($indexes);
        }

        return -1;
    }

    public function __serialize(): array
    {
        return $this->data;
    }

    public function __unserialize(array $data): void
    {
        $this->data = $data;
    }

}
