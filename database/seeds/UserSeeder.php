<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@catalogo.com',
            'password' => admin('password'),
        ]);

        $this->command->info('Usuário admin criado: admin@catalogo.com / password');
    }
}