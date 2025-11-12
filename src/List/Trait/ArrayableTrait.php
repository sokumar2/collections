<?php

namespace Collection\List\Trait;

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
