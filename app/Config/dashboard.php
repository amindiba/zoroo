<?php

return [

    'navigation' => [

        'admin' => [

            [
                'title' => 'مدیریت کاربران',
                'route' => 'dashboard',
            ],

            [
                'title' => 'مدیریت سیستم',
                'route' => 'dashboard',
            ],

        ],


        'producer' => [

            [
                'title' => 'پروفایل تولیدکننده',
                'route' => 'producer.profile.show',
            ],

            [
                'title' => 'ویرایش پروفایل',
                'route' => 'producer.profile.edit',
            ],

            [
                'title' => 'محصولات',
                'route' => 'dashboard',
            ],

        ],


        'buyer' => [

            [
                'title' => 'جستجوی محصولات',
                'route' => 'dashboard',
            ],

            [
                'title' => 'درخواست‌های خرید',
                'route' => 'dashboard',
            ],

            [
                'title' => 'سفارش‌ها',
                'route' => 'dashboard',
            ],

        ],

    ],

];
