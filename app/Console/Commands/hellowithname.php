<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class hellowithname extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hellowithname {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->info('Hello, ' . $name);
        
    }
}
