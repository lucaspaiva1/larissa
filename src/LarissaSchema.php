<?php
namespace Larissa;
use Illuminate\Support\Facades\Schema;
use Larissa\LarissaDraw as Draw;
class LarissaSchema extends Schema
{
	static function create($name, $callback) {
		Draw::$tables[$name] = [];
		Draw::$foreigns[$name] = [];
		new LarissaBlueprint($name, $callback);
	}
}