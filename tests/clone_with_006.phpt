--TEST--
Clone with error cases
--FILE--
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function Kenny1911\CloneWith\clone_with;

$x = new stdClass();

try {
	var_dump(clone_with($x, 1));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

?>
--EXPECTF--
TypeError: Kenny1911\CloneWith\clone_with(): Argument #2 ($withProperties) must be of type array, int given, called in Standard input code on line %d
