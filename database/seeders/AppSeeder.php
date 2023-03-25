<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'super_admin' => '1',
            'admin' => '1',
            'tech' => '1',
            'user' => '1',
            'active' => '1'
        ]);

        DB::table('status')->insert([
            ['descricao' => 'ATIVO'],
            ['descricao' => 'INATIVO']
        ]);

        DB::table('condicoes')->insert([
            ['descricao' => 'Ótimo'],
            ['descricao' => 'Bom'],
            ['descricao' => 'Razoável'],
            ['descricao' => 'Ruim'],
            ['descricao' => 'Péssimo']
        ]);
    }
}
