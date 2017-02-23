<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@mail.ru',
            'password'=>bcrypt('admin'),
            'status'=>'admin',
            'store_id'=>0
        ]);
    }
}
