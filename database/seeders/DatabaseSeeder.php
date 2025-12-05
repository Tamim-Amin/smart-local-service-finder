<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Plumber', 'slug' => 'plumber', 'icon' => '🔧'],
            ['name' => 'Electrician', 'slug' => 'electrician', 'icon' => '⚡'],
            ['name' => 'Tutor', 'slug' => 'tutor', 'icon' => '📚'],
            ['name' => 'Technician', 'slug' => 'technician', 'icon' => '🔨'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}