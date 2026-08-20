<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;



class AdminDashboardController extends Controller
{


    public function index()
    {


        $usersCount = User::count();



        $producerCount = User::whereHas(
            'role',
            function($query){

                $query->where(
                    'slug',
                    'producer'
                );

            }

        )->count();




        $productsCount = Product::count();




        $pendingProductsCount = Product::where(
            'status',
            'pending'
        )->count();




        $activeProductsCount = Product::where(
            'status',
            'active'
        )->count();





        $latestProducts = Product::with([

            'user',
            'category'

        ])

        ->latest()

        ->take(5)

        ->get();






        return view(
            'admin.dashboard',
            compact(

                'usersCount',

                'producerCount',

                'productsCount',

                'pendingProductsCount',

                'activeProductsCount',

                'latestProducts'

            )
        );


    }


}
