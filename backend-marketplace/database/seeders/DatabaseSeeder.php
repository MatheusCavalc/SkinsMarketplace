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

        $skin = \App\Models\Skin::create([
            'name' => 'Canada Assault',
            'category_id' => 1,
            'image_path' => 'public/skins/canada-assault.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Chaos EC 2020',
            'category_id' => 1,
            'image_path' => 'public/skins/Chaos-E-C-2020.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Darkzero 2021',
            'category_id' => 1,
            'image_path' => 'public/skins/darkzero-2021.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Fallen Sun',
            'category_id' => 1,
            'image_path' => 'public/skins/fallen-sun.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Loyal Forces',
            'category_id' => 1,
            'image_path' => 'public/skins/loyal-forces.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Bio Envy',
            'category_id' => 1,
            'image_path' => 'public/skins/bio-envy.png',
            'description' => 'description',
            'popularity' => 99
        ]);

        $skin = \App\Models\Skin::create([
            'name' => 'Mechanical Desire',
            'category_id' => 1,
            'image_path' => 'public/skins/mechanical-desire.png',
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

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 1,
            'skin_id' => 4,
            'price' => 300.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 2,
            'skin_id' => 5,
            'price' => 250.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 2,
            'skin_id' => 6,
            'price' => 280.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 2,
            'skin_id' => 7,
            'price' => 290.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 2,
            'skin_id' => 8,
            'price' => 320.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 2,
            'skin_id' => 9,
            'price' => 380.00,
            'for_sale' => true,
        ]);

        $user_skin  = \App\Models\UserSkin::create([
            'user_id' => 2,
            'skin_id' => 10,
            'price' => 360.00,
            'for_sale' => true,
        ]);
    }
}
