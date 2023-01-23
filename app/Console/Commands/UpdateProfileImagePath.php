<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateProfileImagePath extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:update-default-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates users with default image path.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;
        DB::table('users')->where('image', 'user.png')
            ->chunkById(100, function ($users) {
                foreach ($users as $user) {
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['image' => 'images/user.png']);
                }
            });

        $this->comment("Updated users with default image path.");
        $this->newLine();
        $this->info('All done!');
    }
}
