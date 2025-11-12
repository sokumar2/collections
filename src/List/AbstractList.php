<?php

namespace Collection\List;

use Collection\List\Trait\ArrayableTrait;
use Collection\List\Trait\EmptiableTrait;
use Collection\List\Trait\CountableTrait;
use Collection\List\Contract\ListInterface;

abstract class AbstractList implements ListInterface
{
    use CountableTrait;
    use EmptiableTrait;
    use ArrayableTrait;
}
