<?php

require __DIR__ . '/../../vendor/autoload.php';

use Ig\Generics\Lib\Factories\AbstractFactory;
use Ig\Generics\Lib\Factories\BaseFactory;
use Ig\Generics\Lib\Factories\ImmutableFactory;


const CONFIG = [
    'base' => BaseFactory::class,
    'immutable' => ImmutableFactory::class,
];

function getFactory($type) : AbstractFactory {
    $factoryName = CONFIG[$type];
    return new $factoryName();
}

passArgumentsToGenerateCollection($argv);

function passArgumentsToGenerateCollection(array $argv) {
    $arguments = array_slice($argv, 1);
    validateInput($arguments);
    $type = $arguments[0];
    $class = $arguments[1];
    $genericsNamespace = $arguments[2];
    $genericsPath = $arguments[3];
    $splittedClassName = explode('\\', $class);
    $shortClassName = end($splittedClassName);
    $shortClassNameUUID = uniqid($shortClassName . "__");
    startGenerating($type, $class, $shortClassName, $genericsNamespace, $genericsPath, $shortClassNameUUID);
}

function startGenerating(string $type, string $class, string $shortClassName, string $genericsNamespace, string $genericsPath, string $shortClassNameUUID) {
    $factory = getFactory($type);
    $factory->setType($type);
    $factory->createDirectoryIfNotExisting($genericsPath);
    $factory->createGenericClass($class, $shortClassName, $genericsNamespace, $genericsPath, $shortClassNameUUID);
    $factory->updateGenericsFactory($shortClassName, $genericsNamespace, $genericsPath, $shortClassNameUUID);
}

function validateInput($arguments) {
    if (count($arguments) != 4) {
        throw new Exception("Invalid number of arguments");
    }
    if (!in_array($arguments[0], array_keys(CONFIG))) {
        $invalidType = $arguments[0];
        throw new Exception("Invalid type of collection $invalidType | valid types are: ". implode(', ', array_keys(CONFIG)));
    }
}


?>