<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'John@gmail.com'
        ]);

        Product::factory(6)->create([
            'user_id' => $user->id
        ]);

    }
}
