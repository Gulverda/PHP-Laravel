<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use Storage;

class DateTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:date-time {days}';

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
        $days = intval($this->argument('days'));

        while (true) {
            // Get the current time and add the specified number of days
            $now = Carbon::now()->addDays($days);
            
            // Output the result to the console
            $this->info($now);
            
            // Append the result to the log file
            Storage::append('date-time.log', $now);
            
            // Wait for 10 min before logging again
            sleep(600);
        }
    }
}
