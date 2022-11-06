<?php
namespace NamespaceExample;

use ClassNamespace;
use Exception;
use TestObject;

final class ClassName {

    private array $items;

    public function bulkInsert(array $items) {
        if (count($this->items)) return;
        array_merge($this->items, $items);
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
}
