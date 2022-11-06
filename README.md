## Simple Generic Generator

Generates different type of generics for specific class and allows yoy yto store strictly typed collection

Current types are *base*, *immutable*

Can be extended in future with more templates.

### How to use

```php -f <vendor><package>\src\Lib\CreateGenericClass.php <type> <namespace of object to store> <namespace where your generics are stored> <folder of yoyr generics>```

It generates a *Generic* class in your given folder.

You can create an insatnce of your collection with a cammel case method name in ```GenericsFactory.php```

### Example for generated generic

```
<?php
namespace Ig\Generics\Lib\Namespace;

use Ig\Generics\Lib\Test;
use Exception;


final class Test__63680be4eac8fGenerics {

    private array $items;

    public function bulkInsert(array $items) {
        array_merge($this->items, $items);
    }

    public function add(Test $item) : void {
        $this->items[] = $item;
    }

    public function get(int $id) : Test {
        if (isset($this->items[$id])) {
            return $this->items[$id];
        }
        throw new Exception('Index is missing from array');
    }

    public function count() {
        return count($this->items);
    }

    public function remove(mixed $id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }

    public function insertAt(mixed $id, Test $item) {
        $this->items[$id] = $item;

    }
}
```


```
<?php
namespace Ig\Generics\Lib;
use Ig\Generics\Lib\Namespace\Test__63680be4eac8fGenerics;
final class GenericsFactory {

   public static function genrerateBaseTestCollection() : Test__63680be4eac8fGenerics {
        return new Test__63680be4eac8fGenerics();
    }
}
```
