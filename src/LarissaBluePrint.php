<?php
namespace Larissa;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;
class LarissaBlueprint extends Blueprint
{
 		
 		public function foreign($columns, $name = null)
    {
    	var_dump($columns);
			return $this->indexCommand('foreign', $columns, $name);
    }

    public function on($name) {
    	var_dump($name);
    	return 1;
    }

    public function addColumn($type, $name, array $parameters = [])
    {
        $this->columns[] = $column = new Fluent(
					array_merge(compact('type', 'name'), $parameters)
        );
        LarissaDraw::columnInfo(
        	$this->table,
        	$name,
        	array_merge(compact('type', 'name'), $parameters)
        );
        return $column;
    }
}