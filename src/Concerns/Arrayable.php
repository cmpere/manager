<?php

namespace LiaTec\Manager\Concerns;

trait Arrayable
{
    public function toArray(): array
    {
        return $this->attributes;
    }
}
