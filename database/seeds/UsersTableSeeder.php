<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'pierre thibaudeau',
            'email' =>'pierre.thibaudeau@gmail.com',
            'password' => '$2y$10$HrkKtqyk7HFE51SrT2Mi5uOHJAo3FkvoPMj6mnzYpBdgfa/bq9ZVG',
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>'lewoodstocbroc@gmail.com',
            'password' => '$2y$10$ebon2hsY85g/ItdSCgMpw.4JxwtkbvzkI6KUXkxjXYGWg2xORvk4O',
        ]);
    }
}
