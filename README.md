# Manager
Paquete base del manager proporciona una interfaz unificada que permite extraer objetos mas comodamente por ejemplo:
```php
    ApiResourceCompany::resourceName($iddentity)->resourceMethod()
```
## Usage
Crea un clase que hereda de `Factory` y suscribe los **managers** para poder extraerlas, `FancyManager:class` puede ser cualquier clase
```php
use LiaTec\Manager\Factory;

class FancyFactory extends Factory {

    /**
     * Manager container
     *
     * @var array
     */
    protected $managers = [
        'fancy' => FancyManager::class
    ];

}
```
Para extraer un manager utiliza la llave del arreglo `$managers` como llamada al metodo estatico.
```php
$manager = FancyFactory::fancy($param1,$param2,$paramN);
```

Es posible configurar como se crea cada manager en el metodo `boot` del factory.
```php
    /**
     * Inits each manager
     *
     * @param mixed  $manager - Manager class name
     * @param array  $parameters - Parameter array
     * @param string $name - Manager name (key of $managers)
     *
     * @return mixed
     */
    public function boot($manager, $parameters, $name = null)
    {
        return new $manager(...$parameters);
    }
```
## Licence

This package is open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT) license.

