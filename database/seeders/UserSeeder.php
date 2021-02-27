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
        User::factory([
            'name' => 'Aissam',
            'email' => 'aissam@swissdidata.com',
        ])->create();

        User::factory([
            'name' => 'Riad',
            'email' => 'riad@swissdidata.com',
        ])->create();
        
        User::factory(10)->create();
    }
}
