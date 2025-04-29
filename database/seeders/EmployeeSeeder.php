<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::firstOrCreate([
            'email' => 'emp2@email.app',
            'name' => 'emp ans',
            //'phone_number' => '218910000000',
            'is_active' => true,
            'password' => bcrypt('secret'), // NOTE The password is: secret
        ]);
    }
}
