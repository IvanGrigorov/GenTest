<?php
namespace Ig\Generics\Lib;
use Ig\Generics\Lib\Namespace\TestGenerics;

final class GenericsFactory {

   public static function genrerateTestCollection() : TestGenerics {
        return new TestGenerics();
    }
}
