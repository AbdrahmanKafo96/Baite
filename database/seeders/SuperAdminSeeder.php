<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuperAdmin::firstOrCreate([
            'email' => 'admin@email.app',
            'name' => 'Osamam Admin',
            //   'phone_number' => '218910000000',
            'password' => bcrypt('secret'), // NOTE The password is: secret

        ]);
    }
}
