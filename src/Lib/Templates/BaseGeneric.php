<?php
namespace NamespaceExample;

use ClassNamespace;
use Exception;
use TestObject;

final class ClassName {

    private array $items;

    public function bulkInsert(array $items) {
        array_merge($this->items, $items);
    }

    public function add(TestObject $item) : void {
        $this->items[] = $item;
    }

    public function get(int $id) : TestObject {
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

    public function insertAt(mixed $id, TestObject $item) {
        $this->items[$id] = $item;

    }
}
