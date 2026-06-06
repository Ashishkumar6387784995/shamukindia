<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::query()->delete();

        $states = [
            ['id' => 1, 'name' => 'Andaman and Nicobar Islands', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 2, 'name' => 'Andhra Pradesh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 3, 'name' => 'Arunachal Pradesh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 4, 'name' => 'Assam', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 5, 'name' => 'Bihar', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 6, 'name' => 'Chandigarh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 7, 'name' => 'Chhattisgarh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 9, 'name' => 'Diu & Daman & Dadra & Nagar Haveli', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 10, 'name' => 'Delhi', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 11, 'name' => 'Goa', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 12, 'name' => 'Gujarat', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 13, 'name' => 'Haryana', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 14, 'name' => 'Himachal Pradesh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 15, 'name' => 'Jammu and Kashmir', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 16, 'name' => 'Jharkhand', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 17, 'name' => 'Karnataka', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 19, 'name' => 'Kerala', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 20, 'name' => 'Lakshadweep', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 21, 'name' => 'Madhya Pradesh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 22, 'name' => 'Maharashtra', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 23, 'name' => 'Manipur', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 24, 'name' => 'Meghalaya', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 25, 'name' => 'Mizoram', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 26, 'name' => 'Nagaland', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 29, 'name' => 'Odisha', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 32, 'name' => 'Punjab', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 33, 'name' => 'Rajasthan', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 34, 'name' => 'Sikkim', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 35, 'name' => 'Tamil Nadu', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 36, 'name' => 'Telangana', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 37, 'name' => 'Tripura', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 38, 'name' => 'Uttar Pradesh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 39, 'name' => 'Uttarakhand', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 41, 'name' => 'West Bengal', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 42, 'name' => 'Ladakh', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
            ['id' => 43, 'name' => 'Puducherry', 'country_id' => 105, 'created_at' => null, 'updated_at' => null],
        ];


        foreach ($states as $state) {
            $states_data = new State();
            $states_data->id = $state['id'];
            $states_data->name = $state['name'];
            $states_data->country_id = $state['country_id'];

            $states_data->save();
        }
    }
}
