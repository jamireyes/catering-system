<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeShortcut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php artisan optimize shortcut.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $output = null;
        $ret = null;

        exec('php artisan optimize', $output, $ret);
        echo implode("\n", $output);
    }
}
