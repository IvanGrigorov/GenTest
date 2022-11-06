## Simple Generic Generator

Generates different type of generics for specific class and allows yoy yto store strictly typed collection

Current types are *base*, *immutable*

Can be extended in future with more templates.

### How to use

```php -f <vendor><package>\src\Lib\CreateGenericClass.php <type> <naspace of object to store> <namespace where your generics are stored> <folder of yoyr generics>```

It generates a *Generic* class in your given folder.

You can create an insatnce of your collection with a cammel case method name in ```GenericsFactory.php```

