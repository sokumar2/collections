<?php

namespace Collection\List;

use Traversable;
use Collection\List\AbstractList;
use Collection\List\Contract\ListInterface;

class LinkedList extends AbstractList
{
    protected ?Entry $first = null;

    protected ?Entry $last = null;

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

    public function addFirst(mixed $value): void
    {
        $entry = new Entry($value);

        if (null === $this->first) {
            $this->first = $this->last = $entry;
        } else {
            $entry->next = $this->first;
            $this->first->previous = $entry;
            $this->first = $entry;
        }

        $this->count++;
    }

    public function addLast(mixed $value): void
    {
        $entry = new Entry($value);

        if (null === $this->first) {
            $this->first = $this->last = $entry;
        } else {
            $entry->previous = $this->last;
            $this->last->next = $entry;
            $this->last = $entry;
        }

        $this->count++;
    }

    public function remove(mixed $value): bool
    {
        $entry = $this->first;
        while (null !== $entry) {
            if ($value === $entry->value) {
                $this->removeEntry($entry);

                return true;
            }

            $entry = $entry->next;
        }

        return false;
    }

    private function removeEntry(Entry $entry): void
    {
        if ($entry === $this->first) {
            $this->removeFirst();
        } elseif ($entry === $this->last) {
            $this->removeLast();
        } else {
            $entry->previous->next = $entry->next;
            $entry->next->previous = $entry->previous;

            $entry->next = $entry->previous = null;

            $this->count--;
        }
    }

    public function removeFirst(): mixed
    {
        $entry = $this->first;

        if (null !== $this->first->next) {
            $this->first->next->previous = null;
        } else {
            $this->last = null;
        }

        $this->first = $this->first->next;
        $entry->next = $entry->previous = null;

        $this->count--;

        return $entry->value;
    }

    public function removeLast(): mixed
    {
        $entry = $this->last;

        if (null !== $this->last->previous) {
            $this->last->previous->next = null;
        } else {
            $this->first = null;
        }

        $this->last = $this->last->previous;
        $entry->next = $entry->previous = null;

        $this->count--;

        return $entry->value;
    }

    public function contains(mixed $value): bool
    {
        return $this->containsEntry($this->first, $value);
    }

    private function containsEntry(?Entry $entry, mixed $value): bool
    {
        if (null === $entry) {
            return false;
        } elseif ($value === $entry->value) {
            return true;
        }

        return $this->containsEntry($entry->next, $value);
    }

    public function getIterator(): Traversable
    {
        return (function () {
            for ($entry = $this->first; null != $entry; $entry = $entry->next) {
                yield $entry->value;
            }
        })();
    }

    public function transform(callable $callable): self
    {
        $entry = $this->first;
        while (null !== $entry) {
            $entry->value = call_user_func($callable, $entry->value);
            $entry = $entry->next;
        }

        return $this;
    }

    public function filter(callable $callable): self
    {
        $entry = $this->first;
        while (null !== $entry) {
            $next = $entry->next;
            if (!call_user_func($callable, $entry->value)) {
                $this->removeEntry($entry);
            }

            $entry = $next;
        }

        return $this;
    }

    public function clear(): void
    {
        if (0 < $this->count) {
            $this->first = $this->last = null;
            $this->count = 0;
        }
    }
}
