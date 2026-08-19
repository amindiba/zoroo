<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();


        if (!$user || !$user->role) {
            abort(403, 'Invalid role');
        }


        return match ($user->role->slug) {


            'admin' => view('dashboard.admin', [
                'user' => $user,
            ]),


            'producer' => view('dashboard.producer', [
                'user' => $user,
            ]),


            'buyer' => view('dashboard.buyer', [
                'user' => $user,
            ]),


            default => abort(403, 'Invalid role'),

        };
    }
}
