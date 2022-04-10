<?php

namespace LiaTec\Manager;

use LiaTec\Manager\Concerns\InteractsWithManagers;
use LiaTec\Manager\Contracts\WorksWithManagers;

/**
 * Base class for manager factories
 */
abstract class Factory implements WorksWithManagers
{
    use InteractsWithManagers;

    /**
     * Administra la llamada estatica a la clase
     * crea la instancia realizando proxy al metodo
     * para que sea resuelto por __call
     *
     * @param  string $method
     * @param  array  $parameters
     * @return static
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static())->$method(...$parameters);
    }

    /**
     * Boots factory
     *
     * @param  string $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this, 'boot'], [
            $this->getManager($method),
            $parameters,
            $method,
        ]);
    }
}
