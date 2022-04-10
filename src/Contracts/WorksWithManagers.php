<?php

namespace LiaTec\Manager\Contracts;

interface WorksWithManagers
{
    public function boot($manager, $parameters, $name = null);

    public function getManager(string $name);

    public function setManager(string $name, $class);

    public function getManagers(): array;

    public static function instance();
}
