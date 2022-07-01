<?php

namespace LiaTec\Manager;

use LiaTec\Manager\Contracts\WithAttributes;
use LiaTec\Manager\Contracts\Hydratable;

abstract class Model implements Hydratable, WithAttributes
{
    use Concerns\HydratesModel;
    use Concerns\HasAttributes;
    use Concerns\Arrayable;
}
