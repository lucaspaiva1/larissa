<?php
namespace Larissa;
class LarissaDraw
{
	static $tables = [];
	static function createTable($name) {
		self::$tables[$name] = [];
	}
	static function demo() {
		var_dump(self::$tables);
	}
}