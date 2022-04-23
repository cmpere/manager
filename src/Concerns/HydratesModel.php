<?php

namespace LiaTec\Manager\Concerns;

use LiaTec\Caster\Cast;
use LiaTec\Manager\Hydrator;

trait HydratesModel
{

    public static function inBindings(array $data, array $bindings = []): bool
    {
        $bindings = empty($bindings) ? (new static())->getBindings() : $bindings;
        $found    = array_intersect_key($bindings, $data);

        return count($found) >= count($bindings);
    }

    /**
     * @throws \Exception
     */
    public static function hydrateFromArray(array $data, array $bindings = []): self
    {
        $self = new static();

        if (!empty($bindings)) {
            $self->setBindings($bindings);
        }

        if ($bindings = $self->getBindings()) {
            foreach ($bindings as $attribute => $type) {
                if (!array_key_exists($attribute, $data)) {
                    continue;
                }

                if (is_array($type) && count($type) == 1) {
                    $self->setAttribute($attribute,
                        Hydrator::collection($type[0], $data[$attribute])
                    );

                    continue;
                }

                if (class_exists($type)) {
                    $self->setAttribute($attribute,
                        Hydrator::model($type, $data[$attribute])
                    );

                    continue;
                }

                $self->setAttribute($attribute,
                    Cast::as($data[$attribute], $type)
                );
            }
        }

        return $self;
    }

}
