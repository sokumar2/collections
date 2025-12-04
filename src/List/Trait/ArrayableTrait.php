<?php

namespace SK\Collection\List\Trait;

trait ArrayableTrait
{
    public function toArray(): array
    {
        $list = [];
        foreach($this as $data) {
            $list[] = $data;
        }

        return $list;
    }
}
