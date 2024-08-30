<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        \App\Models\Customers::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        \App\Models\Products::create([
            'name' => 'ABC',
            'description' => 'Cetak ABC',
            'price' => '1000',
            'category' => 'Cetak Digital',
        ]);
        \App\Models\Products::create([
            'name' => 'XYZ',
            'description' => 'Copy XYZ',
            'price' => '1000',
            'category' => 'Fotocopy',
        ]);
        \App\Models\Orders::create([
            'customer_id' => 1,
        ]);
        for ($i = 1; $i < 500; $i++) {
            \App\Models\OrderItems::create([
                'order_id' => 1,
                'products_id' => rand(1, 2),
                'quantity' => 1,
                'price' => 1000
            ]);
        }
    }
}
