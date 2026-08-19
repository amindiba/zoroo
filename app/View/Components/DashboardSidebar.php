<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardSidebar extends Component
{
    public $navigation;


    public function __construct()
    {
        $role = auth()->user()?->role?->slug;


        $this->navigation = config("dashboard.navigation.$role", []);
    }


    public function render(): View|Closure|string
    {
        return view('components.dashboard-sidebar');
    }
}
