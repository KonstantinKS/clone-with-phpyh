--TEST--
Clone with references
--SKIPIF--
<?php

if (PHP_VERSION_ID < 70400) {echo 'skip Reference only with since 7.4';}

?>
--FILE--
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function Kenny1911\CloneWith\clone_with;

$x = new stdClass();

$ref = 'reference';
$with = ['x' => &$ref];

try {
	var_dump(clone_with($x, $with));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

unset($ref);

try {
	var_dump(clone_with($x, $with));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

?>
--EXPECTF--
Error: Cannot assign by reference when cloning with updated properties
object(stdClass)#%d (1) {
  ["x"]=>
  string(9) "reference"
}
