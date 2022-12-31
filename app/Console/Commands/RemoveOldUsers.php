<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RemoveOldUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:del-old-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = User::query()
            ->where('last_login_time', '<', now()->subDays(30))
            ->delete();

        $this->comment("Deleted {$count} inactive users.");
        $this->newLine();
        $this->info('All done!');
    }
}
