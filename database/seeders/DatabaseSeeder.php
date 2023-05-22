<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Equipment;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'login' => 'Provider',
            'email' => 'olesya.nevskaya1@mail.ru',
            'password' => '12345',
            'role' => 'Provider',

        ]);
        User::create([
            'login' => 'Manager',
            'email' => 'serega.kuzovkin@gmail.com',
            'password' => '12345',
            'role' => 'Manager',
        ]);
        User::create([
            'login' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345',
            'role' => 'admin',
        ]);


        Stock::create([

            'name' => 'Северный'

        ]);
        Stock::create([

            'name' => 'Восточный'

        ]);
        Stock::create([

            'name' => 'Западный'

        ]);
        Stock::create([

            'name' => 'Южный'

        ]);

    }
}
