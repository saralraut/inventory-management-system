<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Details;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => "Super Admin",
            'email' => "admin@admin.com",
            'password' => bcrypt('password'),
        ]);

        Details::insert([
            'name' => 'Test',
        ]);
    }
}
