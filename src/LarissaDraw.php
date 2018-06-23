<?php

namespace Larissa;

class LarissaDraw
{
	static $tables = [];
	static $foreigns = [];
	
	static function demo() {
		file_put_contents('database/tables.json', json_encode(self::$tables, JSON_PRETTY_PRINT));
		file_put_contents('database/foreigns.json', json_encode(self::$foreigns, JSON_PRETTY_PRINT));
	}
}