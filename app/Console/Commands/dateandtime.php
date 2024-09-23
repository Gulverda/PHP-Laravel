<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

class dateandtime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dateandtime';

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
        $today = Carbon::today();

        $newYear = Carbon::createFromDate((int)$today->year + 1, 1, 1);

        $daysUntilNewYear = (int) $today->diffInDays($newYear);

        $oneMonthLater = Carbon::createFromDate(
            (int)$today->year,
            (int)$today->month + 1 > 12 ? 1 : (int)$today->month + 1,
            1
        );

        $this->info("Today's Date: " . $today->toDateString());
        $this->info("Date After One Month: " . $oneMonthLater->toDateString());
        $this->info("Days Until New Year from Today: $daysUntilNewYear days");
    }
}
