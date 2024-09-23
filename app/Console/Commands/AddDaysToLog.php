<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AddDaysToLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-days-to-log {days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds the specified number of days to the current date and logs it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $days = intval($this->argument('days'));
        $now = $now->addDays($days);
        
        // Output the result to the console
        $this->info($now);
        
        // Ensure the directory exists
        if (!Storage::exists('days.log')) {
            Storage::put('days.log', ''); // Create the file if it doesn't exist
        }

        // Append the result to the log file
        Storage::append('days.log', $now);
    }
}
