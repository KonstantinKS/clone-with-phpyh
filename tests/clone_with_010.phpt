--TEST--
Clone with native classes
--SKIPIF--
<?php

if (PHP_VERSION_ID < 80000) {echo 'skip';}

?>
--FILE--
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function Kenny1911\CloneWith\clone_with;

try {
	var_dump(clone_with(new \ReflectionClass(stdClass::class), [ 'with' => "something" ]));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

try {
	var_dump(clone_with(new \DateTimeImmutable(), [ 'with' => "something" ]));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

?>
--EXPECTF--
Error: Trying to clone an uncloneable object of class ReflectionClass
Error: Cannot create dynamic property DateTimeImmutable::$with
