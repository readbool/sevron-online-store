<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
             'name' => 'Admin User',
             'email' => 'admin@mail.com',
             'role' => 'admin'
         ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user1@example.com',
            'role' => 'user'
        ]);

        $user = User::factory()->create([
            'name' => \sprintf('Test User %s', fake()->uuid()),
            'email' => \sprintf('user%s@example.com', fake()->numberBetween(100, 1000)),
            'role' => 'user'
        ]);

        Order::factory()->count(10)->for($user)->create();
    }
}
