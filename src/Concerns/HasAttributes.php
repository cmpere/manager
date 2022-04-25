<?php

namespace LiaTec\Manager\Concerns;

/**
 * Permite que un clase maneje atributos
 */
trait HasAttributes
{
    /**
     * Attributes
     *
     * @var array
     */
    protected $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (!$key) {
            return;
        }

        if ($accesor = $this->getAttributeAccesor($key)) {
            return $accesor;
        }

        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Get a given accesor on the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttributeAccesor($key)
    {
        $method = 'get' . ucwords($key) . 'Attribute';

        return method_exists($this, $method) ? call_user_func([$this, $method], $key) : null;
    }

    /**
     * Revisa si existe la llave y si tiene valor diferente de null
     *
     * @param  string  $key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($key, $this->attributes) && !is_null($this->attributes[$key]);
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Gets array object version of attribute
     *
     * @param  string $key
     * @param  mixed  $value
     * @return array
     */
    public function objectAttributeToArray($value): array
    {
        if (!class_exists(get_class($value))) {
            return [];
        }

        if (!method_exists($value, 'toArray')) {
            return $value;
        }

        return $value->toArray();
    }

    /**
     * Gets collection type attribute
     *
     * @param  string $key
     * @param  array  $value
     * @return array
     */
    public function collectionAttributeToArray(array $collection): array
    {
        $arrayable = [];
        foreach ($collection as $key => $item) {
            if (is_array($item)) {
                $arrayable[$key] = $this->collectionAttributeToArray($item);
            }

            if (is_object($item)) {
                $arrayable[] = $this->objectAttributeToArray($item);
            }

            if (is_string($item) || is_numeric($item) || is_bool($item)) {
                $arrayable[$key] = $item;
            }
        }
        return $arrayable;
    }
}
