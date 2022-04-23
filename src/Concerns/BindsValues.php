<?php

namespace LiaTec\Manager\Concerns;

/**
 * Allows value binding
 */
trait BindsValues
{
    /**
     * Bound values
     *
     * @var array<string,mixed>
     */
    protected $bindings = [];

    /**
     * Gets bound value definition
     *
     * @return array
     */
    public function getBindings(): array
    {
        if (property_exists($this, 'bindings')) {
            return $this->bindings;
        }

        return [];
    }

    /**
     * Replace bindings
     *
     * @param  array  $bindings
     */
    public function setBindings(array $bindings): void
    {
        if (property_exists($this, 'bindings')) {
            $this->bindings = $bindings;
        }
    }

    /**
     * Sets binding
     *
     * @param  string  $key
     * @param  string  $binding
     *
     */
    public function setBinding(string $key, string $binding): void
    {
        if (property_exists($this, 'bindings')) {
            $this->bindings = array_merge(
                $this->bindings,
                [$key => $binding]
            );
        }
    }
}
