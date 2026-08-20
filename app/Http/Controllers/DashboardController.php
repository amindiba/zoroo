<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\User;


class DashboardController extends Controller
{

    public function index()
    {

        $user = auth()->user();



        if (!$user) {

            abort(403);

        }




        $user->load([

            'role',

            'producerProfile',

        ]);





        $role = $user->role?->slug;





        if (!$role) {

            abort(403, 'Invalid role');

        }





        $data = [

            'user' => $user,

            'role' => $role,

        ];









        /*
        |--------------------------------------------------------------------------
        | Producer Dashboard Data
        |--------------------------------------------------------------------------
        */



        if ($role === 'producer') {



            $user->load([

                'products.category.parent',

            ]);




            $products = $user->products();





            $data['productCount'] = (clone $products)

                ->count();





            $data['pendingProductCount'] = (clone $products)

                ->where('status', 'pending')

                ->count();





            $data['activeProductCount'] = (clone $products)

                ->where('status', 'active')

                ->count();





            $data['inactiveProductCount'] = (clone $products)

                ->where('status', 'inactive')

                ->count();







            $data['latestProducts'] = $user

                ->products()

                ->with([

                    'category.parent'

                ])

                ->latest()

                ->take(5)

                ->get();







            $profile = $user->producerProfile;



            $data['profileCompleted'] = false;






            if ($profile) {



                $requiredFields = [

                    'company_name',

                    'manager_name',

                    'phone',

                    'province',

                    'city',

                ];







                $data['profileCompleted'] = collect($requiredFields)

                    ->every(function ($field) use ($profile) {


                        return filled($profile->$field);


                    });


            }



        }









        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard Data
        |--------------------------------------------------------------------------
        */



        if ($role === 'admin') {



            $data['userCount'] = User::count();



            $data['productCount'] = Product::count();



            $data['pendingProductCount'] = Product::where(

                'status',

                'pending'

            )->count();





            $data['latestProducts'] = Product::with([

                    'user',

                    'category.parent'

                ])

                ->latest()

                ->take(10)

                ->get();


        }









        /*
        |--------------------------------------------------------------------------
        | Buyer Dashboard Data
        |--------------------------------------------------------------------------
        */



        if ($role === 'buyer') {



            $data['requestCount'] = 0;



            $data['orderCount'] = 0;


        }









        return view(

            'dashboard.index',

            $data

        );


    }

}
