<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'sovannthai@mail.com'
        ], [
            'first_name' => 'Admin',
            'last_name' => 'Sovannthai',
            'email'=>'sovannthai@mail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
