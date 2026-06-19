<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@inovcorp.com',
            'password' => Hash::make('12345678'),
        ]);
        
        User::create([
            'name' => 'Operador Comercial',
            'email' => 'comercial@inovcorp.com',
            'password' => Hash::make('12345678'),
        ]);
        
        User::create([
            'name' => 'Operador Suporte',
            'email' => 'suporte@inovcorp.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}