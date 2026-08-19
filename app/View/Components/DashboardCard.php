<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    public string $title;

    public string $value;

    public string $description;


    public function __construct(
        string $title,
        string $value,
        string $description = ''
    ) {

        $this->title = $title;

        $this->value = $value;

        $this->description = $description;

    }


    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
