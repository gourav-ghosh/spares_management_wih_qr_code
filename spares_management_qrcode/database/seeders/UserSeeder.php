<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'company_id' => '000000',
            'name' => 'Gourav Ghosh',
            'email' => 'gourav01102003.ghosh@gmail.com',
            'phone' => '8603213719',
            'role' => 'Admin',
            'department' => 'Admin',
            'joining_date' => '2023-07-19',
            'password' => '$2y$10$46vjDS.YyIu9qmrHw87yc.zBGbBCXtpfIXnu.8pP.MCtfYnuk.45G',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
    }
}