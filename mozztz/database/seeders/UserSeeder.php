<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'Ali'
        ]);

        User::factory()->create([
            'username' => 'Duman'
        ]);

        User::factory()->create([
            'username' => 'Sanzhar'
        ]);

        User::factory()->create([
            'username' => 'Alisher'
        ]);

        User::factory()->create([
            'username' => 'Dosov'
        ]);

        User::factory()->create([
            'username' => 'Nazira'
        ]);

        User::factory()->create([
            'username' => 'Aruzhan'
        ]);

        User::factory()->create([
            'username' => 'Ainur'
        ]);

        User::factory()->create([
            'username' => 'Azamat'
        ]);

        User::factory()->create([
            'username' => 'Zarina'
        ]);
    }
}
