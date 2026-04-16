--TEST--
Clone with supports property hooks
--SKIPIF--
<?php

if (PHP_VERSION_ID < 80400) {echo 'skip';}

?>
--FILE--
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

class Clazz {
	public string $hooked = 'default' {
		set {
			$this->hooked = strtoupper($value);
		}
	}
}

$c = new Clazz();

var_dump(Kenny1911\CloneWith\clone_with($c, [ 'hooked' => 'updated' ]));

?>
--EXPECTF--
object(Clazz)#%d (1) {
  ["hooked"]=>
  string(7) "UPDATED"
}
