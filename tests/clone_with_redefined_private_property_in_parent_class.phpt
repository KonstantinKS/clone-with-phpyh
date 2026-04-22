--TEST--
Clone with basic
--SKIPIF--
<?php

if (PHP_VERSION_ID >= 80000 && PHP_VERSION_ID < 80100) {echo 'skip';}

?>
--FILE--
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function Kenny1911\CloneWith\clone_with;

abstract class A
{
	private $a = 'a';
}

#[AllowDynamicProperties]
final class B extends A {}

var_dump(clone_with(new B(), ['a' => 'b']));

?>
--EXPECTF--
object(B)#%d (2) {
  ["a":"A":private]=>
  string(1) "a"
  ["a"]=>
  string(1) "b"
}

