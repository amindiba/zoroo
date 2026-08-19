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


        $role = $user->role?->slug;



        if (!$role) {

            abort(403, 'Invalid role');

        }



        return view('dashboard.index', [

            'user' => $user,

            'role' => $role,

        ]);
    }
}
