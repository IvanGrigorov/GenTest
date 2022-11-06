<?php

passArgumentsToGenerateCollection($argv);

function passArgumentsToGenerateCollection(array $argv) {
    $arguments = array_slice($argv, 1);
    $class = $arguments[0];
    $genericsNamespace = $arguments[1];
    $genericsPath = $arguments[2];
    $splittedClassName = explode('\\', $class);
    $shortClassName = end($splittedClassName);
    startGenerating($class, $shortClassName, $genericsNamespace, $genericsPath);
}

function startGenerating(string $class, string $shortClassName,  string $genericsNamespace, string $genericsPath) {
    createDirectoryIfNotExisting($genericsPath);
    createGenericClass($class, $shortClassName, $genericsNamespace, $genericsPath);
    updateGenericsFactory($shortClassName, $genericsNamespace, $genericsPath);

}

function createDirectoryIfNotExisting(string $genericsPath) {
    try {
        if (!is_dir($genericsPath)) {
            mkdir($genericsPath, 0777, true);
        }
    }
    catch(Exception $e) {
        throw new Exception("Cannot create folder for generics at $genericsPath");
    }
}

function createGenericClass(string $class, string $shortClassName, string $genericsNamespace, string $genericsPath) {
    try {
        file_put_contents($genericsPath . DIRECTORY_SEPARATOR. $shortClassName. "Generics.php", "<?php
namespace " .$genericsNamespace. ";

use $class;
use Exception;

final class " .$shortClassName. "Generics {

    private array \$items;

    public function pop() : " .$shortClassName. " {
        return \$this->items[0];
    }

    public function add(" .$shortClassName. " \$item) : void {
        \$this->items[] = \$item;
    }

    public function get(int \$id) : " .$shortClassName. " {
        if (isset(\$this->items[\$id])) {
            return \$this->items[\$id];
        }
        throw new Exception('Index is missing from array');
    }

    public function count() {
        return count(\$this->items);
    }

    public function remove(mixed \$id) {
        if (isset(\$this->items[\$id])) {
            unset(\$this->items[\$id]);
        }
    }

    public function insertAt(mixed \$id, " .$shortClassName. " \$item) {
        \$this->items[\$id] = \$item;

    }
}
");
    }
    catch(Exception $e) {
        throw new Exception("Cannot Generate Generic for class $shortClassName");
    }
}

function updateGenericsFactory(string $shortClassName, string $genericsNamespace, $genericsPath) {
    try {
        $currentData = file_get_contents('./src/Lib/GenericsFactory.php');
        $currentData = rtrim($currentData, "}");
        $currentData = ltrim($currentData, "<?php
namespace Ig\Generics\Lib;");

$currentData = "<?php
namespace Ig\Generics\Lib;
use ".$genericsNamespace."\\".$shortClassName. "Generics;

final class GenericsFactory {

";

$currentData .= "   public static function genrerate" . $shortClassName . "Collection() : ".$shortClassName. "Generics {
        return new ".$shortClassName. "Generics();
    }
}
";
        
        file_put_contents('./src/Lib/GenericsFactory.php', $currentData);
    }
    catch(Exception $e) {
        unlink($genericsPath . DIRECTORY_SEPARATOR. $shortClassName. "Generics.php");
        throw new Exception("Cannot update generic factory for class $shortClassName");
    }
}



?>