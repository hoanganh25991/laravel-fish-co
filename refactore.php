<?php
require_once __DIR__."/vendor/autoload.php";
use Illuminate\Database\Eloquent\Builder;
$reflector = new ReflectionClass(Builder::class);
echo "hello";
echo $reflector->getDocComment();

