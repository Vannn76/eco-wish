<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetUserPassword extends Command
{
    protected $signature = 'reset:password {email} {newPassword}';
    protected $description = 'Reset password user berdasarkan email';

    public function handle()
    {
        $email = $this->argument('email');
        $newPassword = $this->argument('newPassword');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("❌ User dengan email {$email} tidak ditemukan.");
            return 1;
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        $this->info("✅ Password untuk {$email} berhasil di-reset!");
        return 0;
    }
}