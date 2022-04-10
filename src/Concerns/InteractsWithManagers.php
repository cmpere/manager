<?php

namespace LiaTec\Manager\Concerns;

trait InteractsWithManagers
{
    /**
     * Contenedor de managers
     *
     * @var array
     */
    protected $managers = [];

    /**
     * Inits each manager
     *
     * @param mixed  $manager
     * @param array  $parameters
     * @param string $name
     *
     * @return mixed
     */
    public function boot($manager, $parameters, $name = null)
    {
        return new $manager(...$parameters);
    }

    /**
     * Gets factory instance
     */
    public static function instance()
    {
        return new static();
    }

    /**
     * Gets installed managers
     *
     * @return array
     */
    public function getManagers(): array
    {
        return $this->managers;
    }

    /**
     * Sets manager
     *
     * @return array
     */
    public function setManager(string $name, $class)
    {
        $this->managers[$name] = $class;

        return $this;
    }

    /**
     * Gets installed manager
     *
     * @param  string $name
     * @return mixed
     */
    public function getManager(string $name)
    {
        if (!array_key_exists($name, $this->managers)) {
            throw new \Exception(sprintf('"%s" not exists!', $name));
        }

        return $this->managers[$name];
    }
}
