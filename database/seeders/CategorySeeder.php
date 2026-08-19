<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{

    public function run(): void
    {

        $categories = [

            'صنایع فلزی',

            'مواد ساختمانی',

            'ماشین آلات صنعتی',

            'مواد غذایی',

            'کشاورزی',

            'شیمیایی',

            'نساجی',

        ];



        foreach ($categories as $category) {


            Category::firstOrCreate(

                [

                    'slug' => Str::slug($category),

                ],


                [

                    'name' => $category,

                    'description' => null,

                    'status' => true,

                ]

            );


        }

    }

}
