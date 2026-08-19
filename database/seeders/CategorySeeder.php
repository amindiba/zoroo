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

            [
                'name' => 'صنایع فلزی',
                'children' => [
                    'فولاد',
                    'آلومینیوم',
                ],
            ],


            [
                'name' => 'مواد ساختمانی',
                'children' => [
                    'سیمان',
                    'کاشی و سرامیک',
                ],
            ],


            [
                'name' => 'ماشین آلات صنعتی',
                'children' => [
                    'تجهیزات تولید',
                    'ابزار صنعتی',
                ],
            ],


            [
                'name' => 'مواد غذایی',
                'children' => [
                    'محصولات کشاورزی',
                    'مواد فرآوری شده',
                ],
            ],


            [
                'name' => 'کشاورزی',
                'children' => [
                    'محصولات زراعی',
                    'تجهیزات کشاورزی',
                ],
            ],


            [
                'name' => 'شیمیایی',
                'children' => [
                    'مواد اولیه شیمیایی',
                    'محصولات صنعتی شیمیایی',
                ],
            ],


            [
                'name' => 'نساجی',
                'children' => [
                    'پارچه',
                    'الیاف',
                ],
            ],

        ];



        foreach ($categories as $categoryData) {


            $parent = Category::firstOrCreate(

                [
                    'slug' => Str::slug($categoryData['name']),
                ],

                [
                    'name' => $categoryData['name'],
                    'description' => null,
                    'status' => true,
                ]

            );



            foreach ($categoryData['children'] as $child) {


                Category::firstOrCreate(

                    [
                        'slug' => Str::slug($child),
                    ],

                    [
                        'name' => $child,
                        'parent_id' => $parent->id,
                        'description' => null,
                        'status' => true,
                    ]

                );


            }


        }

    }
}
