<?php

namespace LiaTec\Manager\Concerns;

trait Arrayable
{
    /**
     * Gets array object version of attribute
     *
     * @param  mixed $value
     * @return array
     */
    public function objectAttributeToArray($value): array
    {
        if (!class_exists(get_class($value))) {
            return [];
        }

        if (!method_exists($value, 'toArray')) {
            return $value;
        }

        return $value->toArray();
    }

    /**
     * Gets collection type attribute
     *
     * @param  array $collection
     * @return array
     */
    public function collectionAttributeToArray(array $collection): array
    {
        $arrayable = [];
        foreach ($collection as $key => $item) {
            if (is_array($item)) {
                $arrayable[$key] = $this->collectionAttributeToArray($item);
            }

            if (is_object($item)) {
                $arrayable[] = $this->objectAttributeToArray($item);
            }

            if (is_string($item) || is_numeric($item) || is_bool($item)) {
                $arrayable[$key] = $item;
            }
        }
        return $arrayable;
    }

    /**
     * Gets array version of attributes
     *
     * @return array
     */
    public function toArray(): array
    {
        $arrayable = [];
        foreach ($this->attributes as $key => $value) {
            if (is_array($value)) {
                $arrayable[$key] = $this->collectionAttributeToArray($value);
            }

            if (is_object($value)) {
                $arrayable[$key] = $this->objectAttributeToArray($value);
            }

            if (is_string($value) || is_numeric($value) || is_bool($value)) {
                $arrayable[$key] = $value;
            }
        }

        return $arrayable;
    }
}
