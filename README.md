# <p align="center">PHP<br />Data Structures</p>

![Coverage](https://raw.githubusercontent.com/sokumar2/php-collection/refs/heads/master/output/coverage.svg)
[![LICENSE](https://img.shields.io/badge/License-MIT-green)](./LICENSE)
![PHP8](https://img.shields.io/badge/php-%3E%3D8.0-blue?logoColor=white&style=flat)

A set of interfaces in PHP for storing and manipulating a collection of objects.
* [LinkedList](./src/List/LinkedList.php) A double linked list implementation, _add_ is an O(1) operation.
* [ArrayList](./src/List/ArrayList.php) An array backed list gaurantees _set_ and _get_ by index are O(1) operations, _unset_ is O(n).
* [Stack](./src/Stack/Stack.php) A double linked list backed LIFO structure, _push_, _pop_ and _peek_ are all O(1).
* [Queue](./src/Queue/Queue.php) A double linked list backed FIFO structure, _queue_, _dequeue_ and _peek_ are all O(1).

## Usage
### Linked List
You can get an instance of a LinkedList from its factory by calling the `createInstance` method. This ensures that only a concrete implementation of ListInterface is created.
```php
$listFactory = new LinkedListFactory();

$linkedList = $listFactory->createInstance();
```

### Laravel
When using in a Laravel application, you can define the list service as follows (if not taking help of the provided factory method) to ensure that the instantiation is again tied to its implementation.
```php
class ListServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->bind(ListInterface::class, LinkedList::class);
    }

    public function provides(): array
    {
        return [
            ListInterface::class
        ];
    }
}
```

## Tests
```console
composer run test
```
For coverage report, make sure you have xdebug extenstion installed.
```console
composer run coverage
```