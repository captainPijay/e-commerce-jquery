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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
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
    }
}
