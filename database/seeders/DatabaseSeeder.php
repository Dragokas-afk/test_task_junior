<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Equipment;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'login' => 'Provider',
            'email' => 'test@mail.ru',
            'password' => Hash::make('12345'),
            'role' => 'Provider',

        ]);
        User::create([
            'login' => 'Manager',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('12345'),
            'role' => 'Manager',
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
