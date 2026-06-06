<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Mukesh Sharma';
        $user->email = 'shamukindia@gmail.com';
        $user->password = Hash::make('shamuk123');
        $user->role_id = 1;
        $user->mobile_number = '+919820054986';
        $user->pan_number = 'BSAPS30338';
        $user->address = '24A/503 Bimbisar Nagar, Goregaon';
        $user->country_id = 105;
        $user->state_id = 22;
        $user->city_id = 2707;
        $user->is_approved = 1;
        $user->pincode = 400065;
        $user->pass_view = 'shamuk123';
        $user->save();
    }
}
