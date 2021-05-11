<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('administrators')->insert([
            'name' => 'administrator',
            'email' => 'administrator@zfilmaker.com',
            'password' => Hash::make('administrator')
        ]);
    }
}
