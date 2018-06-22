<?php
namespace Larissa;
class LarissaDraw
{
	static $tables = [];
	static function createTable($name) {
		self::$tables[$name] = [];
	}
	static function columnInfo($table, $column, $params) {
		self::$tables[$table][$column] = $params;
	}
	static function demo() {
		file_put_contents('database/preview.json', json_encode(self::$tables, JSON_PRETTY_PRINT));
	}
}