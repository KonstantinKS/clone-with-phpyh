--TEST--
Clone with respects visiblity (no aviz)
--SKIPIF--
<?php

if (PHP_VERSION_ID < 80200) {echo 'skip';}

?>
--FILE--
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function Kenny1911\CloneWith\clone_with;

class P {
	public $a = 'default';
	protected $b = 'default';
	private $c = 'default';

	public function m1() {
		return clone_with($this, [ 'a' => 'updated A', 'b' => 'updated B', 'c' => 'updated C' ]);
	}
}

class C extends P {
	public function m2() {
		return clone_with($this, [ 'a' => 'updated A', 'b' => 'updated B', 'c' => 'dynamic C' ]);
	}
}

$p = new P();

var_dump(clone_with($p, [ 'a' => 'updated A' ]));
var_dump($p->m1());

$c = new C();
var_dump($c->m1());
var_dump($c->m2());

?>
--EXPECTF--
object(P)#%d (3) {
  ["a"]=>
  string(9) "updated A"
  ["b":protected]=>
  string(7) "default"
  ["c":"P":private]=>
  string(7) "default"
}
object(P)#%d (3) {
  ["a"]=>
  string(9) "updated A"
  ["b":protected]=>
  string(9) "updated B"
  ["c":"P":private]=>
  string(9) "updated C"
}
object(C)#%d (3) {
  ["a"]=>
  string(9) "updated A"
  ["b":protected]=>
  string(9) "updated B"
  ["c":"P":private]=>
  string(9) "updated C"
}

Deprecated: Creation of dynamic property C::$c is deprecated in %s on line %d
object(C)#%d (4) {
  ["a"]=>
  string(9) "updated A"
  ["b":protected]=>
  string(9) "updated B"
  ["c":"P":private]=>
  string(7) "default"
  ["c"]=>
  string(9) "dynamic C"
}
