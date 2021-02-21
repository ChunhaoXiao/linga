<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$data = ['username' => 'admin', 'password' => 'admin666'];
        Admin::firstOrCreate(['username' => 'admin'],['password' => 'admin666']);
    }
}
