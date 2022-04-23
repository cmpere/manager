<?php

namespace LiaTec\Manager;

use LiaTec\Manager\Contracts\WorksWithManagers;
use LiaTec\Manager\Concerns\InteractsWithManagers;

/**
 * Base class for manager factories
 */
abstract class Factory implements WorksWithManagers
{
    use InteractsWithManagers;

    /**
     * Inits each manager
     *
     * @param  mixed   $manager
     * @param  array   $parameters
     * @param  string  $name
     */
    public function boot($manager, $parameters, $name = null)
    {
        return new $manager(...$parameters);
    }

    /**
     * BootsBoots factory
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([$this, 'boot'], [
            $this->getManager($method), $parameters, $method,
        ]);
    }


}
