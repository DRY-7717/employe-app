<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AnnualLeave;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        $positions = ['Administrator','Human Resource Development','Manager Programmer', 'Senior Programmer', 'Programmer'];


        foreach ($positions as $position) {
            Position::create(['name' => $position]);
        }

        $user1 = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 1
        ]);
        $user2 = User::create([
            'name' => 'Human Resource Development',
            'email' => 'hrd@example.com',
            'password' => Hash::make('password'),
            'role' => 2
        ]);

        $user1->positions()->attach(1);
        $user2->positions()->attach(2);

        AnnualLeave::create([
            'user_id' => $user1->id
        ]);
        AnnualLeave::create([
            'user_id' => $user2->id
        ]);
    }
}
