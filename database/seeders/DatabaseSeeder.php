<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Notification Admin',
            'email' => 'kesariya.application.live@yahoo.com',
            'password' => Hash::make('HqB(8oLd49MnM'),
        ]);
    }
}
