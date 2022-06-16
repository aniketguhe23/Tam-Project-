<?php

namespace Database\Seeders;

use App\Models\ResourceCategory;
use Illuminate\Database\Seeder;

class ResourceCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $ResourceCategory = [
            [
                'id'                => 1,
                'resource_category' =>"Child Development",   
            ],
            [
                'id'                => 2,
                'resource_category' =>"Psychiatric Hospitals",   
            ],
            [
                'id'                => 3,
                'resource_category' =>"Rehabilitation and De-addiction",   
            ],
            [
                'id'                => 4,
                'resource_category' =>"Career Counselling",   
            ],
            [
                'id'                => 5,
                'resource_category' =>"Geriatric Care",   
            ],

        ];

        ResourceCategory::insert($ResourceCategory);
    }
}
