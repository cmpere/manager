<?php

namespace LiaTec\Manager\Contracts;

interface WithAttributes
{
    public function __construct(array $attributes = []);
}