--TEST--
zend multibyte (11)
--SKIPIF--
--FILE--
<?php
declare(encoding="ISO-8859-15") {
	declare(encoding="ISO-8859-1");
	echo "ok\n";
}
?>
--EXPECTF--
ok
