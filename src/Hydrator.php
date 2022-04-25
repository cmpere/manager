<?php

namespace LiaTec\Manager;

use Exception;
use LiaTec\Manager\Contracts\Hydratable;

/**
 * Hydrates class models and collections
 */
class Hydrator
{
    /**
     * Enforces use of new static()
     */
    final public function __construct()
    {
    }

    /**
     * Hydrates class collection
     *
     * @param string $class
     * @param array  $data
     *
     * @return array
     * @throws Exception
     */
    public static function collection(string $class, array $data): array
    {
        $self = new static();

        if (!$self->implements($class)) {
            throw new Exception("Class {$class} does not implements contract", 1);
        }

        if ($class::inBindings($data)) {
            return [
                $self->model($class, $data),
            ];
        }

        return array_map(function ($it) use ($self, $class) {
            return $self->model($class, $it);
        }, $data);
    }

    /**
     * Queries if class implements Hydratable contract
     *
     * @param string $class
     *
     * @return bool
     * @throws Exception
     */
    public function implements(string $class): bool
    {
        if (!class_exists($class)) {
            throw new Exception("Class {$class} does not exist", 1);
        }

        return in_array(Hydratable::class, class_implements($class));
    }

    /**
     * Hydrates class model
     *
     * @param string $class
     * @param array  $data
     *
     * @return mixed
     * @throws Exception
     */
    public static function model(string $class, array $data)
    {
        if (!(new static())->implements($class)) {
            throw new Exception("Class {$class} does not implements contract", 1);
        }

        return $class::hydrateFromArray($data);
    }
}
