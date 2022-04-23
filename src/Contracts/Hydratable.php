<?php

namespace LiaTec\Manager\Contracts;

interface Hydratable
{
    /**
     * Hydrates model
     *
     * @param  array  $data
     * @param  array  $bindings
     *
     * @return mixed
     */
    public static function hydrateFromArray(array $data, array $bindings = []);

    /**
     * Determines if all $data keys are included in bindings keys
     *
     * @param  array  $data
     * @param  array  $bindings
     *
     * @return bool
     */
    public static function inBindings(array $data, array $bindings = []): bool;
}