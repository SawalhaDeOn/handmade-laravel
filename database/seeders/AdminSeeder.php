<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (!User::where('email', 'admin@landing.ps')->first()) {
            $AdminUser = new User();
            $AdminUser->name = "Admin";
            $AdminUser->email = "admin@landing.ps";
            $AdminUser->password = Hash::make('admin');
            $AdminUser->active = true;
            $AdminUser->mobile = '0000';
            $AdminUser->save();
            $AdminUser->assignRole('super-admin');
            $this->command->info('Admin added  successfully!');
        }
    }
}
