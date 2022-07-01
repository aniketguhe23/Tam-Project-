<?php

use Illuminate\Database\Seeder;
use App\Models\State;

class StateTableSeeder extends Seeder
{
    public function run()
    {
        $states = [
            [
                'state_name' => "Andaman and Nicobar Islands",
                'state_name' => "Andhra Pradesh",
                'state_name' => "Arunachal Pradesh",
                'state_name' => "Assam",
                'state_name' => "Bihar",
                'state_name' => "Chandigarh",
                'state_name' => "Chhattisgarh",
                'state_name' => "Dadra and Nagar Haveli",
                'state_name' => "Daman and Diu",
                'state_name' => "Delhi",
                'state_name' => "Goa",
                'state_name' => "Gujarat",
                'state_name' => "Haryana",
                'state_name' => "Himachal Pradesh",
                'state_name' => "Jammu and Kashmir",
                'state_name' => "Jharkhand",
                'state_name' => "Karnataka",
                'state_name' => "Kenmore",
                'state_name' => "Kerala",
                'state_name' => "Lakshadweep",
                'state_name' => "Madhya Pradesh",
                'state_name' => "Maharashtra",
                'state_name' => "Manipur",
                'state_name' => "Meghalaya",
                'state_name' => "Mizoram",
                'state_name' => "Nagaland",
                'state_name' => "Narora",
                'state_name' => "Natwar",
                'state_name' => "Odisha",
                'state_name' => "Paschim Medinipur",
                'state_name' => "Pondicherry",
                'state_name' => "Punjab",
                'state_name' => "Rajasthan",
                'state_name' => "Sikkim",
                'state_name' => "Tamil Nadu",
                'state_name' => "Telangana",
                'state_name' => "Tripura",
                'state_name' => "Uttar Pradesh",
                'state_name' => "Uttarakhand"
            ],
        ];

        State::insert($states);
    }
}