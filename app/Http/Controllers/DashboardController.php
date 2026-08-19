<?php

namespace App\Http\Controllers;

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

            $data['productCount'] = $user
                ->products()
                ->count();


            $data['latestProducts'] = $user
                ->products()
                ->with('category')
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


        return view(
            'dashboard.index',
            $data
        );
    }
}
