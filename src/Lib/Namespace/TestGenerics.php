<?php
namespace Ig\Generics\Lib\Namespace;

use Ig\Generics\Lib\Test;
use Exception;

final class TestGenerics {

    private array $items;

    public function pop() : Test {
        return $this->items[0];
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
