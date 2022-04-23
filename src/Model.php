<?php

namespace LiaTec\Manager;

use LiaTec\Manager\Contracts\Hydratable;
use LiaTec\Manager\Contracts\WithAttributes;

abstract class Model implements Hydratable, WithAttributes
{
    use Concerns\HydratesModel;
    use Concerns\HasAttributes;
    use Concerns\BindsValues;
    use Concerns\Arrayable;
}
