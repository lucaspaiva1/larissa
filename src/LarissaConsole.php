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
        # This code below is just a approach, will be rewritten in the most closest future
        $folder = 'database/migrations';
        $folder_temp = 'database/temp';
        $migrations = array_filter(scandir($folder), (function($m) {
            return $m != '.' && $m != '..' && $m != 'thumbs.dll' && $m != '.DS_Store';
        }));
        $clean_temp_folder = (function($folder) use ($migrations) {
            foreach ($migrations as $migration) {
                if (file_exists("$folder/$migration")) {
                    unlink("$folder/$migration");
                }
            }
            rmdir("$folder");
        });
        if (file_exists($folder_temp)) $clean_temp_folder($folder_temp);
        mkdir($folder_temp);
        foreach ($migrations as $migration) {
            $this->warn("Reading $migration");
            $altered_migration = file_get_contents("$folder/$migration");
            $altered_migration = str_replace(
                'Illuminate\Support\Facades\Schema',
                'Larissa\LarissaSchema as Schema',
                $altered_migration
            );
            $altered_migration = str_replace(
                'Illuminate\Database\Schema\Blueprint',
                'Larissa\LarissaBlueprint as Blueprint',
                $altered_migration
            );
            preg_match('/class(.*)extends/', $altered_migration, $matches);
            $migration_obj = trim($matches[1]);
            file_put_contents("$folder_temp/$migration", $altered_migration);
            require_once "$folder_temp/$migration";
            $migration_instance = new $migration_obj;
            $migration_instance->up();
            $this->info("Collected $migration");
        }
        $clean_temp_folder($folder_temp);
        LarissaDraw::demo();
    }
}
