<?php

namespace LiaTec\Manager\Concerns;

use Exception;

trait InteractsWithManagers
{
    /**
     * Manager container
     *
     * @var array
     */
    protected $managers = [];

    public function __construct()
    {
    }

    /**
     * Forwards calls
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return static
     */
    public static function __callStatic(string $method, array $parameters)
    {
        return (new static())->$method(...$parameters);
    }

    /**
     * Gets installed manager
     *
     * @param string $name
     *
     * @return string
     * @throws Exception
     */
    public function getManager(string $name): string
    {
        if (!array_key_exists($name, $this->managers)) {
            throw new Exception(sprintf('"%s" not exists!', $name));
        }

        return $this->managers[$name];
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
     */
    public function setManager(string $name, string $class): void
    {
        $this->managers[$name] = $class;
    }
}
