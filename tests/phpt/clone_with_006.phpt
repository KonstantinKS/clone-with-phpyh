--TEST--
Clone with error cases
--FILE--
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$x = new stdClass();

try {
	var_dump(Kenny1911\CloneWith\clone_with($x, 1));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

?>
--EXPECT--
TypeError: Kenny1911\CloneWith\clone_with(): Argument #2 ($withProperties) must be of type array, int given, called in Standard input code on line 8
