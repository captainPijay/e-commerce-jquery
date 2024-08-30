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
            'name' => 'customer 1',
            'email' => 'customer1@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        \App\Models\Customers::create([
            'name' => 'customer 2',
            'email' => 'customer2@gmail.com',
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
            'price' => '100',
            'category' => 'Fotocopy',
        ]);
        \App\Models\Orders::create([
            'customer_id' => 1,
        ]);
        \App\Models\Orders::create([
            'customer_id' => 2,
        ]);
        for ($i = 1; $i <= 500; $i++) {
            \App\Models\OrderItems::create([
                'order_id' => rand(1, 2),
                'products_id' => rand(1, 2),
                'quantity' => 1,
                'price' => 1000
            ]);
        }
    }
}
