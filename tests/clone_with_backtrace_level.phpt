--TEST--
Clone with respects visiblity
--SKIPIF--
<?php

if (PHP_VERSION_ID >= 70400 && PHP_VERSION_ID < 80100) {echo 'skip';}

?>
--FILE--
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use function Kenny1911\CloneWith\clone_with;

final class X
{
  private $x = 'y';

  public function clone() {
    return clone_with($this);
  }
}

(function () {
  (function () {
    (function () {
      var_dump((new X())->clone());
    })();
  })();
})();

?>
--EXPECTF--
object(X)#%d (1) {
  ["x":"X":private]=>
  string(1) "y"
}
