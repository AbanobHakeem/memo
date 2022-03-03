<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class createModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'short cut for create model';

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
        $modelName = $this->ask('what is the model name : ');
        $modelName = str_replace('\\', '\\\\', $modelName);
        $command = "make:model " . $modelName;

        $needMigrateion = $this->confirm("Do you need migration", true);
        $command = ($needMigrateion) ? $command . " -m" : $command;
        Artisan::call($command);
        $this->info("All done sir");
    }
}
