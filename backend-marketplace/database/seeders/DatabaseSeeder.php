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
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'credits' => 1000.00
        ]);

        $user = \App\Models\User::create([
            'name' => 'Test',
            'email' => 'test@test.test',
            'password' => Hash::make('12345678'),
            'credits' => 2000.00
        ]);

        $category = \App\Models\Category::create([
            'name' => 'Mythic'
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Archea Metalica',
            'category_id' => 1,
            'image_path' => 'public/skins/gun-item.jpg',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Rose Thorn',
            'category_id' => 1,
            'image_path' => 'public/skins/thor-rose.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Black Ice',
            'category_id' => 1,
            'image_path' => 'public/skins/black-ice.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 1,
            'skin_id' => 1,
            'price' => 200.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 1,
            'skin_id' => 2,
            'price' => 250.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 1,
            'skin_id' => 3,
            'price' => 500.00,
            'for_sale' => true,
        ]);
    }
}
