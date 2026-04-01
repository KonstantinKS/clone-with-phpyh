--TEST--
Clone with name mangling
--FILE--
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

class Foo {
	private string $bar = 'default';
}

try {
	var_dump(Kenny1911\CloneWith\clone_with(new Foo(), ["\0Foo\0bar" => 'updated']));
} catch (Throwable $e) {
	echo $e::class, ": ", $e->getMessage(), PHP_EOL;
}

?>
--EXPECT--
Error: Cannot access property starting with "\0"
