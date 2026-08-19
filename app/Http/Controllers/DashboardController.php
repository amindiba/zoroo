<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user->role) {
            abort(403, 'User role not assigned.');
        }

        return match ($user->role->name) {

            'Admin' => view('dashboard.admin'),

            'Producer' => view('dashboard.producer'),

            'Buyer' => view('dashboard.buyer'),

            default => abort(403, 'Invalid role.')
        };
    }
}
