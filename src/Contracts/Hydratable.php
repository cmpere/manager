<?php

namespace LiaTec\Manager\Contracts;

interface Hydratable
{
    /**
     * Hydrates model
     *
     * @param array   $data
     * @param array   $bindings
     * @param boolean $includeAllData
     *
     * @return mixed
     */
    public static function hydrateFromArray(
        array $data,
        array $bindings = [],
        bool $includeAllData = false
    );

    /**
     * Determines if all $data keys are included in bindings keys
     *
     * @param array $data
     * @param array $bindings
     *
     * @return bool
     */
    public static function inBindings(array $data, array $bindings = []): bool;

    /**
     * Gets bound value definition
     *
     * @return array
     */
    public function getBindings(): array;

    /**
     * Replace bindings
     *
     * @param array $bindings
     */
    public function setBindings(array $bindings): void;

    /**
     * Sets binding
     *
     * @param string $key
     * @param string $binding
     */
    public function setBinding(string $key, string $binding): void;
}
