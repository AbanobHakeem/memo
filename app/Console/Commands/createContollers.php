<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class createContollers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:con {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this comman is shrort for  careate controllers';

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
     * @return int
     */
    public function handle()
    {
        //create contoller
        $name = $this->argument('name');
        $name = str_replace('\\', '\\\\', $name);
        $command = "make:controller " . $name . "Controller";
        $answer = $this->confirm("is resouse", true);
        $command = ($answer) ? $command . " --resource" : $command;
        Artisan::call($command);
        $this->info("contiller Created");

        //create optinal modal
        $needModel = $this->confirm("Do you need model", true);
        if ($needModel) {
            $modelName = $this->ask('what is the model name : ');
            $modelName = str_replace('\\', '\\\\', $modelName);
            $command = "make:model " . $modelName;

            $needMigrateion = $this->confirm("Do you need migration", true);
            $command = ($needMigrateion) ? $command . " -m" : $command;
            Artisan::call($command);
            $this->info("All done sir");
        }
    }
}
