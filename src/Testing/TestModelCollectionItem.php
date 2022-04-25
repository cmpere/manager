<?php

namespace LiaTec\Manager\Testing;

use LiaTec\Manager\Model;

class TestModelCollectionItem extends Model
{
    protected $bindings = [
        'name'    => 'string',
        'deepArr' => 'array',
    ];
}
