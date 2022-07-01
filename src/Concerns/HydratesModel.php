<?php

namespace LiaTec\Manager\Concerns;

use LiaTec\Manager\Hydrator;

trait HydratesModel
{
    /**
     * Bound values
     *
     * @var array<string,mixed>
     */
    protected $bindings = [];

    /**
     * Determines if all $data keys are included in bindings keys
     *
     * @param array $data
     * @param array $bindings
     *
     * @return bool
     */
    public static function inBindings(array $data, array $bindings = []): bool
    {
        $bindings = empty($bindings) ? (new static())->getBindings() : $bindings;
        $found    = array_intersect_key($bindings, $data);

        return count($found) >= count($bindings);
    }

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
     * @param array $bindings
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
     * @param string $key
     * @param string $binding
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

    /**
     * @throws \Exception
     */
    public static function hydrateFromArray(array $data, array $bindings = [], bool $includeAllData = false): self
    {
        $self = new static();

        if (!empty($bindings)) {
            $self->setBindings($bindings);
        }

        $bindings = $self->getBindings();

        if ($includeAllData) {
            $bindings = array_merge(
                $bindings,
                array_fill_keys(
                    array_diff(array_keys($data), array_keys($bindings)),
                    null
                )
            );
        }

        foreach ($bindings as $attribute => $type) {
            if (!array_key_exists($attribute, $data)) {
                continue;
            }

            $self->setAttribute($attribute, Hydrator::hydrate($type, $data[$attribute]));
        }

        return $self;
    }
}
