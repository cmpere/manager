<?php

namespace LiaTec\Manager\Contracts;

interface WorksWithManagers
{
    /**
     * Enforces use of constructor for static calls
     * a factory can't change constructor signature
     */
    public function __construct();

    public function boot($manager, $parameters, string $name = null);

    public function getManager(string $name): string;

    public function setManager(string $name, string $class): void;

    public function getManagers(): array;

    /**
     * Forwards calls
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return static
     */
    public static function __callStatic(string $method, array $parameters);
}
