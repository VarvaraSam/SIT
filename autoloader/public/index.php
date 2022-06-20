<?php
spl_autoload_register(function ($class_name) {
    $class = str_replace("\\", "/", $class_name);
    $root= dirname(__DIR__) . "/src/{$class}.php";
    require $root;

});
use subdir\Class2;

$cl1 = new Class1();
$cl2 = new Class2();

$cl1->Class1Call();

$cl2->Class2Call();
