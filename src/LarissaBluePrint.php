<?php
namespace Larissa;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;
use Larissa\LarissaDraw as Draw;
class LarissaBlueprint extends Blueprint
{
 		
 		public function foreign($column, $name = null)
    {
    	Draw::$foreigns[$this->table][$column] = [];
			return $this->indexCommand('foreign', $column, $name);
    }
    public function addColumn($type, $name, array $parameters = [])
    {
        $this->columns[] = $column = new Fluent(
					array_merge(compact('type', 'name'), $parameters)
        );
        Draw::$tables[$this->table][$name] = $column;
        foreach ($this->commands as $command) {
        	if (isset($command['columns'])) {
        		foreach ($command['columns'] as $col) {
	        		Draw::$foreigns[$this->table][$col] = [
	        			'references' => $command['references'],
	        			'on' => $command['on']
	        		];
	        	}
        	}
        }
        // Goal $this->commands
        return $column;
    }
}