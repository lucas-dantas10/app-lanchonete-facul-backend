<?php

namespace Database\Seeders;

use App\Models\ItemCart;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'school' => 'Admin'
        ]);

        User::factory()->create([
            'name' => 'lucas',
            'email' => 'lucas@example.com',
            'is_admin' => false,
            'school' => 'Escola teste 2'
        ]);

        Product::factory()->create([
            'name' => 'Agua Com Gás',
            'description'=>'Aguá Gaseficada',
            'price' => 3.50,
            'image_path' => 'http://localhost:8000/storage/products/aguaC.png',

        ]);
        Product::factory()->create([
            'name' => 'Pizza',
            'description'=>'Pizza de Mussarela',
            'price' => 8.00,
            'image_path' => 'http://localhost:8000/storage/products/pizza.png',

        ]);
        Product::factory()->create([
            'name' => 'Hamburguer',
            'description'=>'Hamburguer com pão carne queijo,',
            'price' => 8.00,
            'image_path' => 'http://localhost:8000/storage/products/burger.png',

        ]);
        Product::factory()->create([
            'name' => 'Combo',
            'description'=>'Salgado + Suco ',
            'price' => 9.00,
            'image_path' => 'http://localhost:8000/storage/products/combo.jpg',

        ]);
        Product::factory()->create([
            'name' => 'Refrigerante',
            'description'=>'Lata de Refrigerante',
            'price' => 6.00,
            'image_path' => 'http://localhost:8000/storage/products/refrig.png',

        ]);
        Product::factory()->create([
            'name' => 'sacole',
            'description'=>'Sacole de diversos sabores',
            'price' => 5.00,
            'image_path' => 'http://localhost:8000/storage/products/sacole.png',

        ]);
        Product::factory()->create([
            'name' => 'Água ',
            'description'=>'Aguá Normal',
            'price' => 3.00,
            'image_path' => 'http://localhost:8000/storage/products/aguaS.png',

        ]);
        Product::factory()->create([
            'name' => 'Pipoca',
            'description'=>'Pipoca salgada',
            'price' => 4.00,
            'image_path' => 'http://localhost:8000/storage/products/pipoca.png',

        ]);
        Product::factory()->create([
            'name' => 'Biscoito de Polvilho',
            'description'=>'Biscoito de Polvilho Salgado',
            'price' => 3.00,
            'image_path' => 'http://localhost:8000/storage/products/polvilho.png',

        ]);
        
    }
}
