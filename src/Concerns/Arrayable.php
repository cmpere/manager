<?php

namespace LiaTec\Manager\Concerns;

trait Arrayable
{
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
