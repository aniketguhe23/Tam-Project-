<?php

namespace Database\Seeders;

use App\Models\LibraryCategory;
use Illuminate\Database\Seeder;

class LibraryCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $LibraryCategory = [
            [
                'id'                => 1,
                'library_category' =>"College",   
            ],
            [
                'id'                => 2,
                'library_category' =>"Work",   
            ],
            [
                'id'                => 3,
                'library_category' =>"Relationships",   
            ],
            [
                'id'                => 4,
                'library_category' =>"Personal Growth",   
            ],
            [
                'id'                => 5,
                'library_category' =>"Mental health",   
            ],
            [
                'id'                => 6,
                'library_category' =>"Others",   
            ],

        ];

        LibraryCategory::insert($LibraryCategory);
    }
}
