<?php
require __DIR__ . '/vendor/autoload.php';

use Ig\Generics\Lib\Namespace\TestGenerics;
use Ig\Generics\Lib\Test;

$test = new TestGenerics();
for ($i=0; $i < 10; $i++) { 
    $test->add(new Test($i));
}
var_dump($test->count());
var_dump($test->get(5));
var_dump($test->remove(5));
var_dump($test->count());
var_dump($test->insertAt(5, new Test(54654)));
var_dump($test->count());
var_dump($test->get(5));
var_dump($test->remove(5));
var_dump($test->get(5));
