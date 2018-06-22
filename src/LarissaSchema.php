<?php
namespace Larissa;
use Illuminate\Support\Facades\Schema;
class LarissaSchema extends Schema
{
	static function create($name, $callback) {
		LarissaDraw::createTable($name);
		new LarissaBlueprint($name, $callback);
	}
}