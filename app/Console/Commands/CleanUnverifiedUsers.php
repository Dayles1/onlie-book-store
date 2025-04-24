<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class CleanUnverifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-unverified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users whose email is not verified and older than 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdDate = Carbon::now()->subDays(3);

        $users = User::whereNull('email_verified_at')
                    ->where('created_at', '<=', $thresholdDate)
                    ->get();

        $count = $users->count();

        if ($count === 0) {
            $this->info('No unverified users older than 3 days found.');
            return 0;
        }

        foreach ($users as $user) {
            $this->line("Deleting user: {$user->email}");
            $user->delete();
        }

        $this->info("Deleted $count unverified users.");
        return 0;
    }
}
