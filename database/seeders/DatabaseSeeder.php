<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = [
    ['id' => 1, 'name' => 'كاميرات', 'description' => 'كاميرات الكترونية', 'imagepath' => 'assets\img\p3.jpg'],
    ['id' => 2, 'name' => 'مأكولات', 'description' => 'أكل شعبي وعربي', 'imagepath' => 'assets\img\s2.jpg'],
    ['id' => 3, 'name' => 'مكياج', 'description' => '', 'imagepath' => 'assets/img/f2.jpg'],
    ['id' => 4, 'name' => 'شنط', 'description' => '', 'imagepath' => 'assets/img/m3.jpg'],
    ['id' => 5, 'name' => 'ساعات', 'description' => '', 'imagepath' => 'assets/img/w1.jpg'],
    ['id' => 6, 'name' => 'الكترونيات', 'description' => '', 'imagepath' => 'assets/img/w2.jpg'],
];

/*DB::table('categories')->insertOrIgnore($categories);

       for ($i = 1; $i <= 25; $i++) {
    Product::create([
        'name' => 'Product ' . $i,
        'description' => 'This is product number ' . $i,
        'price' => rand(10, 100), // Random price between 10 and 100
        'quantity' => rand(1, 50), // Random quantity between 1 and 50
        'category_id' => rand(1, 6),
    ]);
}*/
    }
}
