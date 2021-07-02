<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        User::firstOrCreate([
            'name' => 'Elliot',
            'password' => Hash::make('12345678'),
            'created_at' => now()
        ]);
    }
}