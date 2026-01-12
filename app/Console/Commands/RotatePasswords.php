<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RotatePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:rotate-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotate passwords for users who haven\'t changed them in 60 days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for users needing password rotation...');

        // Find users (excluding admins, optional policy) whose password is older than 60 days
        // Or users who have NEVER changed it (if password_last_changed_at is null)
        $users = User::where('role', '!=', 'admin')
            ->where(function ($query) {
                $query->where('password_last_changed_at', '<', Carbon::now()->subDays(60))
                    ->orWhereNull('password_last_changed_at');
            })
            ->get();

        $count = $users->count();
        $this->info("Found {$count} users.");

        foreach ($users as $user) {
            $newPassword = Str::random(12); // Generate secure random password

            // Generate a readable password like "Cloud-9283-Sky" if you prefer, but random is safer.
            // Let's stick to alphanumeric for compatibility.

            $user->update([
                'password' => Hash::make($newPassword),
                'system_generated_password' => encrypt($newPassword), // Encrypt so only admin can view
                'password_last_changed_at' => Carbon::now(),
            ]);

            $this->info("Rotated password for: {$user->email}");
            Log::info("Password rotated for user {$user->id} ({$user->email})");
        }

        $this->info('Password rotation complete.');
    }
}
