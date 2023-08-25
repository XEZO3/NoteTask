<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()->create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password'=>bcrypt("123"),
        ]);
        User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password'=>bcrypt("123"),
        ]);
        User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@gmail.com',
            'password'=>bcrypt("123"),
        ]);
        User::factory()->create([
            'name' => 'user4',
            'email' => 'user4@gmail.com',
            'password'=>bcrypt("123"),
        ]);

        Note::factory()->create([
            'title' => 'note1',
            'note' => 'lorem',
            'user_id'=>1,
        ]);
        Note::factory()->create([
            'title' => 'noteq',
            'note' => 'lorem',
            'user_id'=>2,
        ]);
        Note::factory()->create([
            'title' => 'note3',
            'note' => 'lorem',
            'user_id'=>3,
        ]);
        Note::factory()->create([
            'title' => 'note4',
            'note' => 'lorem',
            'user_id'=>4,
        ]);
    }
}
