<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //         $user = User::create([...]);
// $user->roles()->attach($roleId); // Assuming you have the role's ID
        User::firstOrCreate([
            'email' => 'client1@email.app',
            'name' => 'ans client',
            'phone_number' => '218910000000',
            'is_active' => true,
            'is_trusted' => true,
            'location' => 'fsjfolfnweofhwefsofnwol;fbwoewfbdfwfouw',
            'password' => bcrypt('secret'), // NOTE The password is: secret
        ]);
    }
}
