<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OpenPhpMyAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:pma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open phpmyadmin on default browser.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $output = null;
        $ret = null;

        exec('start http://localhost/phpmyadmin', $output, $ret);
        echo implode("\n", $output);
    }
}
