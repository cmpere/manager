<?php

namespace LiaTec\Manager\Testing;

use LiaTec\Manager\Model;

/**
 * LiaTec\Manager\Model\TestModel
 *
 * $property array $isModelCollection
 */
class TestModel extends Model
{
    protected $bindings = [];

    public function getCustomAttribute($key): string
    {
        return 'custom';
    }
}
