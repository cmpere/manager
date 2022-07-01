<?php

namespace LiaTec\Manager\Contracts;

interface WithAttributes
{
    public function __construct(array $attributes = []);

    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key);

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value);

    /**
     * Get a given accesor on the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttributeAccesor($key);

    /**
     * Revisa si existe la llave y si tiene valor diferente de null
     *
     * @param  string  $key
     * @return boolean
     */
    public function has($key);

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key);

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value);
}
