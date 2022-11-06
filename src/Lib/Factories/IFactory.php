<?php 
namespace Ig\Generics\Lib\Factories;

interface IFactory {

    public function setType(string $typr) : void;

    public function createDirectoryIfNotExisting(string $genericsPath) : void;

    public function createGenericClass(string $class, string $shortClassName, string $genericsNamespace, string $genericsPath, string $shortClassNameUUID) : void;

    public function updateGenericsFactory(string $shortClassName, string $genericsNamespace, string $genericsPath, string $shortClassNameUUID) : void;

}
