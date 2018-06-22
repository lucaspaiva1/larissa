<?php
namespace Larissa;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;
class LarissaBlueprint extends Blueprint
{
 		
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