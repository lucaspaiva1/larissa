<?php
namespace Larissa;
use Illuminate\Console\Command;
class LarissaConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:preview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Craft database preview';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$folder = 'database/migrations';
    	$filter = (function($m) { return $m != '.' && $m != '..'; });
        $migrations = array_filter(scandir($folder), $filter);
        if (file_exists("$folder/temp")) {
        	array_map('unlink', glob("$folder/temp/*.*"));
        	rmdir("$folder/temp");
        }
        mkdir("$folder/temp");
        foreach ($migrations as $migration) {
        	$alteredMigration = file_get_contents("$folder/$migration");
        	$alteredMigration = str_replace('Facades\Schema', 'Larissa\LarissaSchema as Schema', $alteredMigration);
        	$alteredMigration = str_replace('Schema\Blueprint', 'Larissa\LarissaBlueprint as Blueprint', $alteredMigration);
        	file_put_contents("$folder/temp/$migration", $alteredMigration);
        }
    }
}
