<?php 
namespace Ig\Generics\Lib\Factories;

use Exception;

abstract class AbstractFactory implements IFactory {

    protected string $template;
    protected string $type;


    public function setType(string $type) : void {
        $this->type = $type;
    }

    public function createDirectoryIfNotExisting(string $genericsPath) : void {
        try {
            if (!is_dir($genericsPath)) {
                mkdir($genericsPath, 0777, true);
            }
        }
        catch(Exception $e) {
            throw new Exception("Cannot create folder for generics at $genericsPath");
        }
    }

    public function createGenericClass(string $class, string $shortClassName, string $genericsNamespace, string $genericsPath, string $shortClassNameUUID) : void {
        try {
            $baseGenericContent = file_get_contents($this->template);
            $baseGenericContent = str_replace('use TestObject;', '', $baseGenericContent);
            $baseGenericContent = str_replace('NamespaceExample', $genericsNamespace, $baseGenericContent);
            $baseGenericContent = str_replace('ClassNamespace', $class, $baseGenericContent);
            $baseGenericContent = str_replace('ClassName', $shortClassNameUUID. "Generics", $baseGenericContent);
            $baseGenericContent = str_replace('TestObject', $shortClassName, $baseGenericContent);
            file_put_contents($genericsPath . DIRECTORY_SEPARATOR. $shortClassNameUUID. "Generics.php", $baseGenericContent);
        }
        catch(Exception $e) {
            throw new Exception("Cannot Generate Generic for class $shortClassName");
        }
    }
    
    public function updateGenericsFactory(string $shortClassName, string $genericsNamespace, string $genericsPath, string $shortClassNameUUID) : void {
        try {
            $currentData = file_get_contents('./src/Lib/GenericsFactory.php');
            $currentData = rtrim($currentData, "}");
            $currentData = ltrim($currentData, "<?php
    namespace Ig\Generics\Lib;");
    
             $currentData = "<?php
namespace Ig\Generics\Lib;
use ".$genericsNamespace."\\".$shortClassNameUUID. "Generics;
" . $currentData;

            $currentData .= "   public static function genrerate" . ucfirst($this->type) . $shortClassName . "Collection() : ".$shortClassNameUUID. "Generics {
        return new ".$shortClassNameUUID. "Generics();
    }
}";
            
            file_put_contents('./src/Lib/GenericsFactory.php', $currentData);
        }
        catch(Exception $e) {
            unlink($genericsPath . DIRECTORY_SEPARATOR. $shortClassName. "Generics.php");
            throw new Exception("Cannot update generic factory for class $shortClassName");
        }
    }

}
