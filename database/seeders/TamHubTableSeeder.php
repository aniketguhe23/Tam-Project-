<?php

namespace Database\Seeders;

use App\Models\Tamhub;
use Illuminate\Database\Seeder;

class TamhubTableSeeder extends Seeder
{
    public function run()
    {
        $Tamhub = [
            [
                
                'id'                    => 1,
                'organisation_name'     => 'CADRRE',
                'resource_category_id'  => 1,
                'city'                  => 'Trivandrum',
                'areas'                 => 'Autism Spectrum Disorders Only',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],
            [
                'id'                => 2,
                'organisation_name'     => 1,
                'resource_category_id'  => '',
                'city'                  => '',
                'areas'                 => '',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],
            [
                'id'                => 3,
                'organisation_name'     => 1,
                'resource_category_id'  => '',
                'city'                  => '',
                'areas'                 => '',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],
            [
                'id'                => 4,
                'organisation_name'     => 1,
                'resource_category_id'  => '',
                'city'                  => '',
                'areas'                 => '',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],
            [
                'id'                => 5,
                'organisation_name'     => 1,
                'resource_category_id'  => '',
                'city'                  => '',
                'areas'                 => '',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],
            [
                'id'                => 6,
                'organisation_name'     => 1,
                'resource_category_id'  => '',
                'city'                  => '',
                'areas'                 => '',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],
            [
                'id'                => 7,
                'organisation_name'     => 1,
                'resource_category_id'  => '',
                'city'                  => '',
                'areas'                 => '',
                'services'              => '',
                'special_note'          => '',
                'contact_no'            => '',
                'email_id'              => '',
                'website_link'          => '',
                'address'               => '',   
            ],

        ];

        Tamhub::insert($Tamhub);
    }
}
